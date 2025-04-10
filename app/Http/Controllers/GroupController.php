<?php
namespace App\Http\Controllers;

use App\Models\Cohort;
use App\Models\Group;
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
        $schools = Cohort::all();
        $users = collect();
        $groups = Group::all();
        return view('pages.groups.index', compact('schools', 'users', 'groups'));
    }

    public function create(Request $request) {
        $promotion = $request->input('promotion');
        $number = $request->input('number');
        $users = User::where('cohort', $promotion)->get();

        // Supprimer les groupes existants pour cette promotion
        Group::where('promotion', $promotion)->delete();

        // Créer des groupes pour les utilisateurs de cette promotion
        $groupNumber = 1;
        $groupUsers = [];

        foreach ($users as  $user) {
            // Ajouter l'utilisateur dans un groupe jusqu'à ce que le groupe atteigne la taille spécifiée
            if (count($groupUsers) < $number) {
                $groupUsers[] = $user;
            } else {
                // Sauvegarder le groupe et en créer un nouveau
                $group = Group::create([
                    'promotion' => $promotion,
                    'group_number' => $groupNumber,
                ]);

                foreach ($groupUsers as $groupUser) {
                    $group->users()->attach($groupUser);
                }

                // Réinitialiser le tableau des utilisateurs pour le prochain groupe
                $groupUsers = [$user];
                $groupNumber++;
            }
        }

        // Sauvegarder le dernier groupe si nécessaire
        if (!empty($groupUsers)) {
            $group = Group::create([
                'promotion' => $promotion,
                'group_number' => $groupNumber,
            ]);

            foreach ($groupUsers as $groupUser) {
                $group->users()->attach($groupUser);
            }
        }

        // Récupérer tous les groupes pour l'affichage après la soumission
        $groups = Group::all();
        $schools = Cohort::all();

        return view('pages.groups.index', compact('schools', 'users', 'groups'));
    }



    public function clear(Request $request)
    {
        $promotion = $request->input('promotion');
        Group::where('promotion', $promotion)->delete();

        $groups = Group::all();
        return view('pages.groups.index', compact('groups'));
    }

}
