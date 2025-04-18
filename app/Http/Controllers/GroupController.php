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


    // function to show groups page
    public function index(Request $request) {
        $promotionId = $request->input('promotion');
        $cohorts = Cohort::all();
        $users = collect();
        $groups = Group::all();
        $search = $request->input('search');

        //filter les promos
        if ($promotionId) {
            $groups = Group::with('cohort')->where('promotion', $promotionId)->get();
        } else {
            $groups = Group::all();
        }

        if ($search) {
            // recherche pour sql aussi avec % 'Like en sql'
            $groupSearch = Group::with('cohort')->whereHas('users', function ($query) use ($search) {
                $query->where('first_name', 'like', "%$search%")
                    ->orWhere('last_name', 'like', "%$search%");
            })->get();
        } else {
            $groupSearch = Group::all();
        }

        return view('pages.groups.index', compact('cohorts', 'users','groups','groupSearch'));
    }


    // function to create groups
    public function create(Request $request)
    {
        // get promotion id from request
        $promotion = $request->input('promotion');
        // get number of groups from request
        $number = $request->input('number');

        // get all users of the promotion
        $users = User::whereHas('cohorts', function($query) use ($promotion) {
            $query->where('cohorts_id', $promotion);
        })->get();

        // if number is not between 2 and 10
        if ($number < 2) {
            return redirect()->back()->withErrors("error nombre trop petit");
        }elseif ($number > 10) {
            return redirect()->back()->withErrors("error nombre trop grand");
        }

        // Supprimer les groupes existants
        Group::where('promotion', $promotion)->delete();

        // create groups
        $groupNumber = 1;
        $groupUsers = [];

        // for each user, create a group with the same number of users
        foreach ($users as $user) {
            // if the number of users in the group is less than the number of users in the promotion, add the user to the group
            if (count($groupUsers) < $number) {
                $groupUsers[] = $user;
            }
            // else create a new group with the same number of users as the previous group and add the user to the new group
            else
            {
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
            // if there are still users in the group, create a new group with the remaining users
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



    // function to delete groups
    public function clear(Request $request)
    {
        $promotion = $request->input('promotion');
        Group::where('promotion', $promotion)->delete();

        $groups = Group::all();
        $cohorts = Cohort::all();
        return view('pages.groups.index', compact('groups','cohorts'));
    }

}
