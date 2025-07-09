<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;


class DashboardController extends Controller
{
    // DISPLAY DASHBOARD PAGE
    public function adminDashboard()
    {
        if (auth()->user()->role === 'super_admin' && auth()->user()->role === 'admin') {
            abort(403, 'Unauthorized action.');
        }

        return view('pages.dashboard');
    }
    public function viewDetailsPage(){
        // return view('pages.details.details');
        return view('pages.single.manage.manage');
    }
}
