<?php

namespace App\Http\Controllers;

use App\Models\Crop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PageController extends Controller
{
    public function home()
    {
        $datas = Crop::all();
        return view('pages.contract', compact('datas'));
    }

    public function showSingleServicePage($service)
    {
        return view("pages.services.$service");
    }

    public function contract()
    {
         $datas = Crop::all();
        // dd($data);
        return view('pages.contract', compact('datas'));
    }

    public function tradingExport()
    {
        $crops = Crop::all();

        return view('pages.trading-and-export', compact('crops'));
    }
}
