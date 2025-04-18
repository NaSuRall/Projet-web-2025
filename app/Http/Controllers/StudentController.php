<?php

namespace App\Http\Controllers;

use App\Models\Retro;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index()
    {
        // take all users
        $Allusers = User::all();
        // return view to variable $Allusers
        return view('pages.students.index',compact('Allusers'));
    }
}
