<?php

namespace App\Http\Controllers;

use App\Models\Cohort;
use App\Models\Liste;
use App\Models\Retro;
use App\Models\Task;
use App\Models\User;
use App\Models\UserCohort;
use Illuminate\Http\Request;

class RetroTemplateController extends Controller
{

    public function index($id)
    {
        $retro = Retro::findOrFail($id);
        $cohort = Cohort::find($retro->cohort_id);
        $users = User::whereIn('id', UserCohort::where('cohorts_id', $retro->promotion)->pluck('user_id'))->get();




        return view('pages.retros.retro-template', compact('retro','cohort', 'users'));
    }
    public function create(Request $request){
        $name = $request->input('name');
        $promotion = $request->input('promotion');
        $users = UserCohort::where('cohorts_id', $promotion)->get();


        $retro = Retro::create([
            'name' => $name,
            'promotion' => $promotion,
            'creator_id' => $request->input('creator_id'),
        ]);
        return redirect()->back()->with(compact('users'));
    }



}
