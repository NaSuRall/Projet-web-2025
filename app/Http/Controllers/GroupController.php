<?php

namespace App\Http\Controllers;

use App\Models\Cohort;
use App\Models\User;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Afficher la page avec les utilisateurs filtrés.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index() {
        // Récupérer toutes les écoles (cohortes)
        $schools = Cohort::all();

        // Initialiser la collection des utilisateurs
        $users = collect();

        // Retourner la vue avec les écoles et les utilisateurs filtrés
        return view('pages.groups.index', compact('schools', 'users'));
    }

    public function create(Request $request) {
        // Récupérer la promotion sélectionnée
        $promotion = $request->input('promotion');

        // Filtrer les utilisateurs en fonction de la promotion
        if ($promotion) {
            $users = User::where('cohort', $promotion)->get();
        } else {
            // Si aucune promotion n'est sélectionnée, on retourne tous les utilisateurs
            $users = User::all();
        }
        // Récupérer toutes les écoles (cohortes) pour le formulaire
        $schools = Cohort::all();
        // Retourner la vue avec les utilisateurs filtrés
        return view('pages.groups.index', compact('schools', 'users'));
    }
}
