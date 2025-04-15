<?php
namespace App\Http\Controllers;

use App\Models\Cohort;
use App\Models\Group;
use App\Models\User;
use App\Models\UserCohort;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    /**
     * Afficher la page avec les utilisateurs filtrés.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request) {
        $promotionId = $request->input('promotion');
        $cohorts = Cohort::all();
        $users = collect();
        $groups = Group::all();
        $search = $request->input('search');
        //filter les promos
        if ($promotionId) {
            $groups = Group::where('promotion', $promotionId)->get();
        } else {
            $groups = Group::all();
        }

        if ($search) {
            // recherche pour sql aussi avec % 'Like en sql'
            $groupSearch = Group::whereHas('users', function ($query) use ($search) {
                $query->where('first_name', 'like', "%$search%")
                    ->orWhere('last_name', 'like', "%$search%");
            })->get();
        } else {
            $groupSearch = Group::all();
        }

        return view('pages.groups.index', compact('cohorts', 'users','groups','groupSearch'));
    }

    public function create(Request $request)
    {
        $promotion = $request->input('promotion');
        $number = $request->input('number');

        $users = User::whereHas('cohorts', function($query) use ($promotion) {
            $query->where('cohorts_id', $promotion);
        })->get();

        // Supprimer les groupes existants
        Group::where('promotion', $promotion)->delete();

        $groupNumber = 1;
        $groupUsers = [];

        foreach ($users as $user) {
            if (count($groupUsers) < $number) {
                $groupUsers[] = $user;
            } else {
                $group = Group::create([
                    'promotion' => $promotion,
                    'group_number' => $groupNumber,
                ]);
                foreach ($groupUsers as $groupUser) {
                    $group->users()->attach($groupUser);
                }
                $groupUsers = [$user];
                $groupNumber++;
            }
        }

        if (!empty($groupUsers)) {
            $group = Group::create([
                'promotion' => $promotion,
                'group_number' => $groupNumber,
            ]);
            foreach ($groupUsers as $groupUser) {
                $group->users()->attach($groupUser);
            }
        }

        $groups = Group::all();
        $schools = Cohort::all();
        $cohorts = Cohort::all();

        return view('pages.groups.index', compact('schools', 'users', 'groups', 'cohorts'));
    }



    public function clear(Request $request)
    {
        $promotion = $request->input('promotion');
        Group::where('promotion', $promotion)->delete();

        $groups = Group::all();
        $cohorts = Cohort::all();
        return view('pages.groups.index', compact('groups','cohorts'));
    }

}
