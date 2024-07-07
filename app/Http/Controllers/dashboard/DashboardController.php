<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    // DISPLAY DASHBOARD PAGE
    public function viewDashbaordPage(){
        return view('pages.dashboard');
    }
    public function viewDetailsPage(){
        // return view('pages.details.details');
        return view('pages.single.manage.manage');
    }
}
