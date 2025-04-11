<?php

namespace Database\Seeders;

use App\Models\Cohort;
use App\Models\School;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\UserCohort;
use App\Models\UserSchool;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Psy\Util\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create the default user
        $admin = User::create([
            'last_name'     => 'Admin',
            'first_name'    => 'Admin',
            'email'         => 'admin@codingfactory.com',
            'password'      => Hash::make('123456'),
            'role'          => 'admin',
        ]);

        $teacher = User::create([
            'last_name'     => 'Teacher',
            'first_name'    => 'Teacher',
            'email'         => 'teacher@codingfactory.com',
            'password'      => Hash::make('123456'),
            'role'          => 'teacher',
        ]);

        $user = User::create([
            'last_name'     => 'Student',
            'first_name'    => 'Student',
            'email'         => 'student@codingfactory.com',
            'password'      => Hash::make('123456'),
            'role'          => 'student',
        ]);


        // Create the default school
        $schoolCergy = School::create([
            'user_id'   => $user->id,
            'name'      => 'Coding Factory Cergy',
        ]);

        $schoolParis = School::create([
            'user_id'   => $user->id,
            'name'      => 'Coding Factory Paris',
        ]);




        // Create the admin role
        UserSchool::create([
            'user_id'   => $admin->id,
            'school_id' => $schoolCergy->id,
            'role'      => 'admin'
        ]);

        // Create the teacher role
        UserSchool::create([
            'user_id'   => $teacher->id,
            'school_id' => $schoolCergy->id,
            'role'      => 'teacher'
        ]);

        // Create the student role
        UserSchool::create([
            'user_id'   => $user->id,
            'school_id' => $schoolCergy->id,
            'role'      => 'student'
        ]);


        Cohort::create([
            'school_id'   => $schoolCergy->id,
            'name'        => 'B1 Cergy',
            'description' => 'Desctiption: B1',
            'start_date'  => date('Y-m-d'),
            'end_date'  => date('Y-m-d'),
        ]);

       $cohort = Cohort::create([
            'school_id'   => $schoolParis->id,
            'name'        => 'B1 Paris',
            'description' => 'Desctiption: B1',
            'start_date'  => date('Y-m-d'),
            'end_date'  => date('Y-m-d'),
        ]);


        Cohort::create([
            'school_id'   => $schoolCergy->id,
            'name'        => 'B2 Cergy',
            'description' => 'Desctiption: B2',
            'start_date'  => date('Y-m-d'),
            'end_date'  => date('Y-m-d'),
        ]);

        Cohort::create([
            'school_id'   => $schoolParis->id,
            'name'        => 'B2 Paris',
            'description' => 'Desctiption: B2',
            'start_date'  => date('Y-m-d'),
            'end_date'  => date('Y-m-d'),
        ]);


        Cohort::create([
            'school_id'   => $schoolCergy->id,
            'name'        => 'B3 Cergy',
            'description' => 'Desctiption: B3',
            'start_date'  => date('Y-m-d'),
            'end_date'  => date('Y-m-d'),
        ]);

        Cohort::create([
            'school_id'   => $schoolParis->id,
            'name'        => 'B3 Paris',
            'description' => 'Desctiption: B3',
            'start_date'  => date('Y-m-d'),
            'end_date'  => date('Y-m-d'),
        ]);

        Cohort::create([
            'school_id'   => $schoolCergy->id,
            'name'        => 'M1 Cergy',
            'description' => 'Desctiption: M1',
            'start_date'  => date('Y-m-d'),
            'end_date'  => date('Y-m-d'),
        ]);

        Cohort::create([
            'school_id'   => $schoolParis->id,
            'name'        => 'M1 Paris',
            'description' => 'Desctiption: M1',
            'start_date'  => date('Y-m-d'),
            'end_date'  => date('Y-m-d'),
        ]);


        Cohort::create([
            'school_id'   => $schoolCergy->id,
            'name'        => 'M2 Cergy',
            'description' => 'Desctiption: M2',
            'start_date'  => date('Y-m-d'),
            'end_date'  => date('Y-m-d'),
        ]);

        Cohort::create([
            'school_id'   => $schoolParis->id,
            'name'        => 'M2 Paris',
            'description' => 'Desctiption: M2',
            'start_date'  => date('Y-m-d'),
            'end_date'  => date('Y-m-d'),
        ]);


        UserCohort::create([
            'user_id'   => $user->id,
            'cohorts_id' => $cohort->id,
        ]);

        UserCohort::create([
            'user_id'   => $teacher->id,
            'cohorts_id' => $cohort->id,
        ]);

        $cohorts = Cohort::all(); // Récupère toutes les cohortes

        User::factory(100)->create()->each(function ($user) use ($cohorts) {
            // Choisit une cohorte aléatoire
            $randomCohort = $cohorts->random();

            // Crée l'association dans la table pivot
            UserCohort::create([
                'user_id'    => $user->id,
                'cohorts_id' => $randomCohort->id,
            ]);
        });
    }
}
