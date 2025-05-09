<?php

use App\Events\MessageSent;
use App\Http\Controllers\CohortController;
use App\Http\Controllers\CommonLifeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RetroController;
use App\Http\Controllers\RetroTemplateController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\KnowledgeController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

// Redirect the root path to /dashboard
Route::redirect('/', 'dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('verified')->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Cohorts
        Route::get('/cohorts', [CohortController::class, 'index'])->name('cohort.index');
        Route::get('/cohort/{cohort}', [CohortController::class, 'show'])->name('cohort.show');

        // Teachers
        Route::get('/teachers', [TeacherController::class, 'index'])->name('teacher.index');

        // Students
        Route::get('students', [StudentController::class, 'index'])->name('student.index');

        // Knowledge
        Route::get('knowledge', [KnowledgeController::class, 'index'])->name('knowledge.index');




        // Groups
        // Route for show the groups page
        Route::get('groups', [GroupController::class, 'index'])->name('group.index');
        // Route for create a new group
        Route::get('groups/promotions', [GroupController::class, 'create'])->name('group.create');
        // Route for delete group
        Route::post('groups/delete', [GroupController::class, 'clear'])->name('group.clear');

        // Route pour les retros

        // route show reto pages
        Route::get('retros', [RetroController::class, 'index'])->name('retro.index');
        // route create retro template
        Route::post('retros/create', [RetroTemplateController::class, 'create'])->name('retro.create');
        // Route for delete retro
        Route::delete('retros/delete', [RetroController::class, 'delete'])->name('retro.delete');


        // Retro Template

        // Route for show the template retro with id
        Route::get('retros/group/{id}', [RetroTemplateController::class, 'index'])->name('retro.show');
        // Route for create a new column
        Route::post('retros/createColumn', [RetroTemplateController::class, 'createColumn'])->name('retro.createColumn');
        // Route for create a new card
        Route::post('retros/createCard', [RetroTemplateController::class, 'createCard'])->name('retro.createCard');
        // Route for delete card with id on parameter
        Route::delete('/card/{id}', [RetroTemplateController::class, 'destroyCard'])->name('card.delete');
        // Route for delete column with id on parameter
        Route::delete('/column/{id}', [RetroTemplateController::class, 'destroyColumn'])->name('column.delete');




        // Common life
        Route::get('common-life', [CommonLifeController::class, 'index'])->name('common-life.index');
        // test
        Route::get('/test-pusher', function () {
            broadcast(new MessageSent('Hello depuis Laravel !'));
            return 'Événement envoyé !';
        });
    });

});

require __DIR__.'/auth.php';
