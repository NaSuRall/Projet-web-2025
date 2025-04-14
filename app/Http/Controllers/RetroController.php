<?php

namespace App\Http\Controllers;

use App\Models\Cohort;
use App\Models\Group;
use App\Models\Retro;
use App\Models\UserCohort;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RetroController extends Controller
{
    /**
     * Display the page
     *
     * @return Factory|View|Application|object
     */
    public function index() {
        $cohorts = Cohort::all();
        $user = Auth::user();

        if ($user->role === 'student') {
            $cohortIds = $user->cohorts->pluck('id');
            $retros = Retro::whereIn('promotion', $cohortIds)->get();
        }  elseif ($user->role === 'teacher') {
            $retros = Retro::where('creator_id', $user->id)->get();
        }
        else {
            $retros = Retro::all();
        }

        return view('pages.retros.index', compact('retros', 'cohorts'));
    }


    public function delete(Request $request)
    {
        $promotion = $request->input('promotion');
        Retro::where('promotion', $promotion)->delete();

        $groups = Group::all();
        $cohorts = Cohort::all();
        $Allretros = Retro::all();
        return view('pages.retros.index', compact('groups','cohorts','Allretros'));
    }
}
