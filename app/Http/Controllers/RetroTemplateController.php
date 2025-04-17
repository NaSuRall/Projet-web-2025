<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Card;
use App\Models\Cohort;
use App\Models\Column;
use App\Models\Retro;
use App\Models\User;
use App\Models\UserCohort;
use Illuminate\Http\Request;

class RetroTemplateController extends Controller
{

    public function index($id)
    {
        $retro = Retro::with('board.columns.cards')->findOrFail($id);
        $cohort = Cohort::find($retro->cohort_id);
        $users = User::whereIn('id', UserCohort::where('cohorts_id', $retro->promotion)->pluck('user_id'))->get();

        return view('pages.retros.retro-template', compact('retro', 'cohort', 'users'));
    }



    public function create(Request $request){

        $name = $request->input('name');
        $promotion = $request->input('promotion');
        $users = UserCohort::where('cohorts_id', $promotion)->get();

        if ($request->has('retroRapide')){
            $retro = Retro::create([
                'name' => $name,
                'promotion' => $promotion,
                'creator_id' => $request->input('creator_id'),
            ]);

            $board = Board::create([
                'name' => $name,
                'retro_id' => $retro->id,
                'cohort_id' => $promotion,
            ]);

            Column::create([
                'name' => 'J\'ai aimer',
                'board_id' => $board->id,
            ]);

            Column::create([
                'name' => 'Je n\'ai pas aimer',
                'board_id' => $board->id,
            ]);

            Column::create([
                'name' => 'A modifier',
                'board_id' => $board->id,
            ]);
            return redirect()->back()->with(compact('board'));
        }

        $retro = Retro::create([
            'name' => $name,
            'promotion' => $promotion,
            'creator_id' => $request->input('creator_id'),
        ]);

        $board = Board::create([
            'name' => $name,
            'retro_id' => $retro->id,
            'cohort_id' => $promotion,
        ]);

        return redirect()->back()->with(compact('users','board'));
    }


    public function createColumn(Request $request){
        $name = $request->input('name');
        $board_id = $request->input('board_id');
        Column::create([
            'name' => $name,
            'board_id' => $board_id,
        ]);
        return redirect()->back();
    }

    public function createCard(Request $request)
    {
        $card = new Card();
        $card->column_id = $request->column_id;
        $card->user_id = $request->user_id;
        $card->description = $request->textarea;
        $card->save();

        return response()->json($card);
    }

    public function destroyCard($id)
    {
        $card = Card::findOrFail($id);
        $card->delete();
        return redirect()->back();
    }

    public function destroyColumn($id)
    {
        $column = Column::findOrFail($id);
        $column->cards()->delete();
        $column->delete();
        return redirect()->back();
    }



}
