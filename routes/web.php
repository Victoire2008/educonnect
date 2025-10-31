<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;


Route::get('/', [UserController::class, 'index'])->name('user.index');

// Groupe de routes pour la partie admin

 Route::prefix('admin')->group(function() {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    // Tableau de bord (affiche les formulaires + listes)
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');

    // Ajout d’un établissement
    Route::post('/etablissement', [AdminController::class, 'storeetablissement'])->name('admin.storeEtablissement');

    // Ajout d’une filière
    Route::post('/filiere', [AdminController::class, 'storefiliere'])->name('admin.storeFiliere');

    // Attribution d’une ou plusieurs filières à un établissement
    Route::post('/assign', [AdminController::class, 'assignfiliereToetablissement'])->name('admin.assignFiliere');
});
