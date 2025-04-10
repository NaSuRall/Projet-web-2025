<?php

namespace App\Http\Controllers;

use App\Models\Liste;
use App\Models\Retro;
use Illuminate\Http\Request;

class RetroTemplateController extends Controller
{

    public function index($id)
    {
        $retro = Retro::findOrFail($id);
        return view('pages.retros.retro-template', compact('retro'));
    }
    public function create(Request $request){
        $name = $request->input('name');
        $promotion = $request->input('promotion');


        $retro = Retro::create([
            'name' => $name,
            'promotion' => $promotion,
            'creator_id' => $request->input('creator_id'),
        ]);
        return redirect()->back();
    }
}
