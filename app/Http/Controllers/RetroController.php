<?php

namespace App\Http\Controllers;

use App\Models\Retro;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class RetroController extends Controller
{
    /**
     * Display the page
     *
     * @return Factory|View|Application|object
     */
    public function index() {

        $Allretros = Retro::all();
        return view('pages.retros.index', compact('Allretros'));
    }
}
