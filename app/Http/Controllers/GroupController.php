<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display the page
     *
     * @return Factory|View|Application|object
     */
    public function index() {
        $groups = Group::with('users')->get();
        return view('pages.groups.index', compact('groups'));
    }




    public function formCreate(Request $request) {
        $nombreUtilisateurs = User::count();
        $parGroupe = $request->input('number');

        if ($parGroupe <= 0) {
            return back()->with('error', 'Le nombre d’utilisateurs par groupe doit être supérieur à 0.');
        }

        $nombreGroupes = ceil($nombreUtilisateurs / $parGroupe);

        $utilisateurs = User::all()->shuffle(); // Mélange ici
        $chunks = $utilisateurs->chunk($parGroupe);
        $numero = 1;

        foreach ($chunks as $groupeUtilisateurs) {
            $groupe = Group::create([
                'name' => 'Groupe ' . $numero
            ]);

            foreach ($groupeUtilisateurs as $utilisateur) {
                $utilisateur->group_id = $groupe->id;
                $utilisateur->save();
            }

            $numero++;
        }

        return back()->with('success', "$nombreGroupes groupes ont été créés aléatoirement.");
    }


}
