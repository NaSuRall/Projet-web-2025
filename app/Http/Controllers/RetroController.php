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
    public function index() {
        $cohorts = Cohort::all();
        $user = Auth::user();
        $boards = Board::all();

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

        $retros = Retro::where('promotion', $promotion)->with('boards.columns')->get();

        foreach ($retros as $retro) {
            foreach ($retro->boards as $board) {
                $board->columns()->delete(); // Supprime les colonnes
            }

            $retro->boards()->delete(); // Supprime les boards
            $retro->delete(); // Supprime le rétro
        }

        return redirect()->back()->with('success', 'Rétrospectives supprimées.');
    }
}
