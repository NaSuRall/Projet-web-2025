<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $userRole = auth()->user()->school()->pivot->role;
        $groups = Group::all();
        return view('pages.dashboard.dashboard-' . $userRole, compact('groups'));
    }
}
