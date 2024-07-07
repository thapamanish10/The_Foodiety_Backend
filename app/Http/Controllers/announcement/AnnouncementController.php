<?php

namespace App\Http\Controllers\announcement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    //
    public function index()
    {
        return view('pages.announcement.announcement');
    }
    public function create()
    {
        return view('pages.announcement.form.announcement');
    }
}
