<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ExpertVisitRegistration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;
use Throwable;

class ExpertVisitController extends Controller
{
    public function index(Request $request): View
    {
        $dbError = null;
        $registrations = null;
        $statusCounts = [
            'all' => 0,
            'paid' => 0,
            'pending' => 0,
            'order_failed' => 0,
        ];

        try {
            if (!Schema::hasTable('expert_visit_registrations')) {
                $dbError = 'The expert_visit_registrations table does not exist in the database. Please run: php artisan migrate';
            } else {
                $query = ExpertVisitRegistration::with('farms');

                if ($request->filled('status') && in_array($request->status, ['paid', 'pending', 'order_failed'], true)) {
                    $query->where('payment_status', $request->status);
                }

                if ($request->filled('search')) {
                    $search = trim((string) $request->search);
                    $query->where(function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%")
                            ->orWhere('father_name', 'like', "%{$search}%")
                            ->orWhere('surname', 'like', "%{$search}%")
                            ->orWhere('mobile', 'like', "%{$search}%")
                            ->orWhere('reference', 'like', "%{$search}%")
                            ->orWhere('razorpay_order_id', 'like', "%{$search}%")
                            ->orWhere('razorpay_payment_id', 'like', "%{$search}%");
                    });
                }

                $statusCounts['all'] = ExpertVisitRegistration::count();
                $statusCounts['paid'] = ExpertVisitRegistration::where('payment_status', 'paid')->count();
                $statusCounts['pending'] = ExpertVisitRegistration::where('payment_status', 'pending')->count();
                $statusCounts['order_failed'] = ExpertVisitRegistration::where('payment_status', 'order_failed')->count();

                $registrations = $query->latest()->paginate(15)->withQueryString();
            }
        } catch (Throwable $e) {
            Log::error('Could not load expert visit registrations in admin', ['error' => $e->getMessage()]);
            $dbError = 'Database error: ' . $e->getMessage();
        }

        return view('dashboard.expert_visits.index', compact('registrations', 'statusCounts', 'dbError'));
    }

    public function show(int $id): View|RedirectResponse
    {
        try {
            $registration = ExpertVisitRegistration::with('farms')->findOrFail($id);
            return view('dashboard.expert_visits.show', compact('registration'));
        } catch (Throwable $e) {
            return redirect()
                ->route('admin.expert-visits.index')
                ->with('error', 'Unable to load registration: ' . $e->getMessage());
        }
    }

    public function destroy(int $id): RedirectResponse
    {
        try {
            $registration = ExpertVisitRegistration::findOrFail($id);
            $registration->delete();

            return redirect()
                ->route('admin.expert-visits.index')
                ->with('success', 'Registration removed successfully.');
        } catch (Throwable $e) {
            return redirect()
                ->route('admin.expert-visits.index')
                ->with('error', 'Unable to delete registration: ' . $e->getMessage());
        }
    }
}
