<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ControllerDashboard extends Controller
{
    public function index(){
        return view('admins.dashboard');
    }
}
