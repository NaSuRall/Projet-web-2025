<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Group;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $userRole = auth()->user()->school()->pivot->role;
        return view('pages.dashboard.dashboard-' . $userRole, );
    }
}
