<?php

namespace App\Http\Controllers;

use App\Models\ExpertVisitRegistration;
use App\Services\ExpertVisitPricing;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
use Razorpay\Api\Errors\Error as RazorpayError;
use WpOrg\Requests\Exception as RequestException;

class ExpertVisitRegistrationController extends Controller
{
    public function create()
    {
        return view('pages.expert-visit-registration', [
            'states' => ExpertVisitPricing::states(),
            'stateRates' => ExpertVisitPricing::stateRates(),
            'feeGroups' => ExpertVisitPricing::feeGroups(),
            'checkoutReady' => $this->checkoutIsConfigured(),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        if (!$this->checkoutIsConfigured()) {
            return response()->json([
                'message' => 'Registration checkout is not configured yet. Please try again later.',
            ], 503);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'father_name' => ['required', 'string', 'max:100'],
            'surname' => ['required', 'string', 'max:100'],
            'mobile' => ['required', 'regex:/^[6-9][0-9]{9}$/'],
            'residential.village' => ['required', 'string', 'max:120'],
            'residential.taluka' => ['required', 'string', 'max:120'],
            'residential.district' => ['required', 'string', 'max:120'],
            'residential.state' => ['required', 'string', Rule::in(ExpertVisitPricing::states())],
            'residential.pincode' => ['required', 'digits:6'],
            'farms' => ['required', 'array', 'min:1', 'max:5'],
            'farms.*.village' => ['required', 'string', 'max:120'],
            'farms.*.taluka' => ['required', 'string', 'max:120'],
            'farms.*.district' => ['required', 'string', 'max:120'],
            'farms.*.state' => ['required', 'string', Rule::in(ExpertVisitPricing::states())],
            'farms.*.pincode' => ['required', 'digits:6'],
            'farms.*.mobile' => ['required', 'regex:/^[6-9][0-9]{9}$/'],
            'farms.*.area_acres' => ['required', 'numeric', 'gt:0', 'max:100000'],
            'nearest_railway_station' => ['required', 'string', 'max:150'],
            'preferred_visit_date' => ['required', 'date', 'after_or_equal:today'],
            'visit_days' => ['required', 'integer', 'min:1', 'max:30'],
            'policy_accepted' => ['accepted'],
        ], [
            'mobile.regex' => 'Enter a valid 10-digit Indian mobile number.',
            'farms.*.mobile.regex' => 'Enter a valid 10-digit Indian mobile number for each farm.',
            'policy_accepted.accepted' => 'You must accept the registration and visit policies to continue.',
        ]);

        $feePerDay = max(array_map(
            fn (array $farm) => ExpertVisitPricing::rateForState($farm['state']),
            $validated['farms']
        ));
        $totalFee = $feePerDay * (int) $validated['visit_days'];
        $reference = (string) Str::uuid();

        try {
            $registration = DB::connection('expert_visits')->transaction(function () use (
                $validated,
                $feePerDay,
                $totalFee,
                $reference
            ) {
                $registration = ExpertVisitRegistration::create([
                    'reference' => $reference,
                    'name' => $validated['name'],
                    'father_name' => $validated['father_name'],
                    'surname' => $validated['surname'],
                    'mobile' => $validated['mobile'],
                    'residential_village' => $validated['residential']['village'],
                    'residential_taluka' => $validated['residential']['taluka'],
                    'residential_district' => $validated['residential']['district'],
                    'residential_state' => $validated['residential']['state'],
                    'residential_pincode' => $validated['residential']['pincode'],
                    'nearest_railway_station' => $validated['nearest_railway_station'],
                    'preferred_visit_date' => $validated['preferred_visit_date'],
                    'visit_days' => $validated['visit_days'],
                    'fee_per_day' => $feePerDay,
                    'total_fee' => $totalFee,
                    'payment_status' => 'pending',
                    'terms_accepted_at' => now(),
                ]);

                $registration->farms()->createMany($validated['farms']);

                return $registration;
            });
        } catch (\PDOException $exception) {
            Log::error('Expert visit registration could not be saved.', [
                'error' => $exception->getMessage(),
            ]);

            return response()->json([
                'message' => 'We could not save your registration. Please try again later.',
            ], 503);
        }

        $receipt = 'evr_' . Str::lower(Str::random(20));

        try {
            $order = (new Api(
                config('services.razorpay.key_id'),
                config('services.razorpay.key_secret')
            ))->order->create([
                'receipt' => $receipt,
                'amount' => $totalFee * 100,
                'currency' => 'INR',
                'notes' => [
                    'registration_reference' => $reference,
                    'purpose' => 'Expert farm visit registration',
                ],
            ]);
        } catch (RazorpayError|RequestException $exception) {
            Log::error('Razorpay expert visit order creation failed.', [
                'registration_reference' => $reference,
                'error' => $exception->getMessage(),
            ]);

            $registration->update(['payment_status' => 'order_failed']);

            return response()->json([
                'message' => 'Your registration details were saved, but payment could not be started. Please retry or contact us.',
            ], 502);
        }

        try {
            $registration->update([
                'razorpay_order_id' => $order->id,
                'payment_status' => 'pending',
            ]);
        } catch (QueryException $exception) {
            Log::critical('Razorpay order could not be linked to expert visit registration.', [
                'registration_reference' => $reference,
                'razorpay_order_id' => $order->id,
                'error' => $exception->getMessage(),
            ]);

            return response()->json([
                'message' => 'Payment was created but could not be linked to your registration. Please contact us before retrying.',
            ], 503);
        }

        return response()->json([
            'key' => config('services.razorpay.key_id'),
            'order_id' => $order->id,
            'amount' => $order->amount,
            'currency' => 'INR',
            'reference' => $reference,
            'name' => trim($validated['name'] . ' ' . $validated['surname']),
            'mobile' => $validated['mobile'],
        ]);
    }

    public function verifyPayment(Request $request): JsonResponse
    {
        if (!$this->checkoutIsConfigured()) {
            return response()->json(['message' => 'Payment verification is unavailable.'], 503);
        }

        $validated = $request->validate([
            'reference' => ['required', 'uuid'],
            'razorpay_order_id' => ['required', 'string', 'max:100'],
            'razorpay_payment_id' => ['required', 'string', 'max:100'],
            'razorpay_signature' => ['required', 'string', 'max:255'],
        ]);

        $registration = ExpertVisitRegistration::query()
            ->where('reference', $validated['reference'])
            ->where('razorpay_order_id', $validated['razorpay_order_id'])
            ->firstOrFail();

        if ($registration->payment_status === 'paid') {
            return response()->json(['message' => 'Payment was already verified.']);
        }

        $api = new Api(
            config('services.razorpay.key_id'),
            config('services.razorpay.key_secret')
        );

        try {
            $api->utility->verifyPaymentSignature([
                'razorpay_order_id' => $validated['razorpay_order_id'],
                'razorpay_payment_id' => $validated['razorpay_payment_id'],
                'razorpay_signature' => $validated['razorpay_signature'],
            ]);

            $payment = $api->payment->fetch($validated['razorpay_payment_id']);
        } catch (SignatureVerificationError $exception) {
            Log::warning('Invalid Razorpay signature for expert visit registration.', [
                'registration_reference' => $registration->reference,
            ]);

            return response()->json(['message' => 'Payment verification failed. Please contact us if your account was charged.'], 422);
        } catch (RazorpayError|RequestException $exception) {
            Log::error('Razorpay expert visit payment verification request failed.', [
                'registration_reference' => $registration->reference,
                'error' => $exception->getMessage(),
            ]);

            return response()->json(['message' => 'Payment status could not be confirmed yet. Please try again shortly.'], 502);
        }

        if (
            $payment->order_id !== $registration->razorpay_order_id ||
            (int) $payment->amount !== $registration->total_fee * 100 ||
            $payment->currency !== 'INR' ||
            $payment->status !== 'captured'
        ) {
            Log::warning('Razorpay expert visit payment did not match expected order details.', [
                'registration_reference' => $registration->reference,
                'razorpay_payment_id' => $validated['razorpay_payment_id'],
                'payment_status' => $payment->status,
            ]);

            return response()->json([
                'message' => 'Payment is not confirmed yet. If your account was charged, please contact us.',
            ], 409);
        }

        try {
            DB::connection('expert_visits')->transaction(function () use ($registration, $validated) {
                $registration->update([
                    'razorpay_payment_id' => $validated['razorpay_payment_id'],
                    'payment_status' => 'paid',
                ]);
            });
        } catch (QueryException $exception) {
            Log::critical('Verified expert visit payment could not be saved.', [
                'registration_reference' => $registration->reference,
                'razorpay_payment_id' => $validated['razorpay_payment_id'],
                'error' => $exception->getMessage(),
            ]);

            return response()->json([
                'message' => 'Payment was received but confirmation could not be saved. Please contact us with your registration reference.',
            ], 503);
        }

        return response()->json([
            'message' => 'Payment confirmed. Your expert visit registration is complete.',
            'reference' => $registration->reference,
        ]);
    }

    private function checkoutIsConfigured(): bool
    {
        $connection = config('database.connections.expert_visits');
        $databaseReady = filled($connection['url'] ?? null) || (
            filled($connection['host'] ?? null) &&
            filled($connection['database'] ?? null) &&
            filled($connection['username'] ?? null)
        );

        return $databaseReady &&
            filled(config('services.razorpay.key_id')) &&
            filled(config('services.razorpay.key_secret'));
    }
}
