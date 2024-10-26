<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboardadmin()
    {
        $users = User::all();
        return view('admin.dashboard',compact('users'));
    }

    public function dashboardvalidateur()
    {
        return view('validateur.dashboard');
    }

    public function dashboardlanceurconcour()
    {
        return view('lanceurconcour.dashboard');
    }
}
