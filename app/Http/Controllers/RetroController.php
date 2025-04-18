<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Card;
use App\Models\Cohort;
use App\Models\Column;
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


    // function to show retros page
    public function index() {
        $cohorts = Cohort::all();
        $user = Auth::user();
        $boards = Board::all();

        // if user is student
        if ($user->role === 'student') {
            $cohortIds = $user->cohorts->pluck('id');
            // get all retros of the user's cohorts'
            $retros = Retro::whereIn('promotion', $cohortIds)->get();
        }  elseif ($user->role === 'teacher') {
            // get all retros of the user's cohorts'
            $retros = Retro::where('creator_id', $user->id)->get();
        }
        else {
            // get all retros
            $retros = Retro::all();
        }
        // return view retros.index with retros and cohorts
        return view('pages.retros.index', compact('retros', 'cohorts'));
    }



    // function to delete retros
    public function delete(Request $request)
    {
        // get promotion id from request
        $promotion = $request->input('promotion');
        // get all retros of the promotion
        $retros = Retro::where('promotion', $promotion)->with('boards.columns')->get();

        // boucle for each retro to delete all boards and columns
        foreach ($retros as $retro) {
            foreach ($retro->boards as $board) {
                $board->columns()->delete();
            }

            $retro->boards()->delete();
            $retro->delete();
        }
            // return back with success message
        return redirect()->back()->with('success', 'Rétrospectives supprimées.');
    }
}
