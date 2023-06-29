<?php

namespace App\Http\Controllers;

use App\Models\invoice;
use Illuminate\Http\Request;

class report_controller extends Controller
{
    public function report_daily()
    {
        if (session()->get('admin_id')) {
            $date = date('Y-m-d');
            $invoice = invoice::where('date', $date)->get();
            return view('reports.daily', (['invoice' => $invoice]));
        } else {
            return redirect('/');
        }
    }
}
