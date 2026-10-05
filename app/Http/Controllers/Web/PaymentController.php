<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $farmers = User::where('user_status', 'active')->get();
        return view('dashboard.payment.index', compact('farmers'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $farmers = User::with([
            'farms' => function ($query) {
                $query->whereHas('subscriptions'); // Only fetch farms that have subscriptions
            },
            'farms.subscriptions'
        ]) // Load their subscriptions
            ->where('id', $request->user_id)
            ->firstOrFail();

        // dd($farmers);


        return view('dashboard.payment.create', compact('farmers'));
    }
}
