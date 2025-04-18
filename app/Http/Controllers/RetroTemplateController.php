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


    // function to show templates page retro width id on parameter
    public function index($id)
    {
        $retro = Retro::with('board.columns.cards')->findOrFail($id);
        $cohort = Cohort::find($retro->cohort_id);
        $users = User::whereIn('id', UserCohort::where('cohorts_id', $retro->promotion)->pluck('user_id'))->get();

        return view('pages.retros.retro-template', compact('retro', 'cohort', 'users'));
    }



    // function to create a retro
    public function create(Request $request){

        $name = $request->input('name');
        $promotion = $request->input('promotion');
        $users = UserCohort::where('cohorts_id', $promotion)->get();


        // if checkbox is checked ( Retro rapide )
        if ($request->has('retroRapide')){

            // create retro and board with columns
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
            // return route width id of retro
            return redirect()->route('retro.show', ['id' => $retro->id]);
        }


        // else create retro and board without columns
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
        // return back
        return redirect()->back()->with(compact('users','board'));
    }



    // function to create a column
    public function createColumn(Request $request){
        $name = $request->input('name');
        $board_id = $request->input('board_id');
        $columnCount = Column::where('board_id', $board_id)->count();

        // if column count is 4
        if ($columnCount >= 4) {
            // return back
            return redirect()->back()->with('error', 'pas plus de 4 colonnes.');
        }
        // else create column
        Column::create([
            'name' => $name,
            'board_id' => $board_id,
        ]);
        return redirect()->back();
    }


    // function to create a card AJAX
    public function createCard(Request $request)
    {
        // new card widh column id, user id, description
        $card = new Card();
        $card->column_id = $request->column_id;
        $card->user_id = $request->user_id;
        $card->description = $request->textarea;
        $card->save();

        return response()->json($card);
    }

    // function to delete a card
    public function destroyCard($id)
    {
        // find card by id
        $card = Card::findOrFail($id);
        // delete card where id is $id
        $card->delete();
        return redirect()->back();
    }

    // function to delete a column
    public function destroyColumn($id)
    {
        $column = Column::findOrFail($id);
        $column->cards()->delete();
        $column->delete();
        return redirect()->back();
    }



}
