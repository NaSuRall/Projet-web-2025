<?php

namespace App\Http\Controllers;

use App\Models\Cohort;
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
        $cohorts = Cohort::all();
        return view('pages.retros.index', compact('Allretros', 'cohorts'));
    }
}
