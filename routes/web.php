<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;


Route::get('/', [UserController::class, 'index'])->name('user.index');

// Groupe de routes pour la partie admin

Route::prefix('admin')->group(function() {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');

    // CRUD Établissements
    Route::post('/etablissement', [AdminController::class, 'storeEtablissement'])->name('admin.storeEtablissement');
    Route::get('/etablissement/{id}/edit', [AdminController::class, 'editEtablissement'])->name('admin.editEtablissement');
    Route::put('/etablissement/{id}', [AdminController::class, 'updateEtablissement'])->name('admin.updateEtablissement');
    Route::delete('/etablissement/{id}', [AdminController::class, 'deleteEtablissement'])->name('admin.deleteEtablissement');

    // CRUD Filières
    Route::post('/filiere', [AdminController::class, 'storeFiliere'])->name('admin.storeFiliere');
    Route::get('/filiere/{id}/edit', [AdminController::class, 'editFiliere'])->name('admin.editFiliere');
    Route::put('/filiere/{id}', [AdminController::class, 'updateFiliere'])->name('admin.updateFiliere');
    Route::delete('/filiere/{id}', [AdminController::class, 'deleteFiliere'])->name('admin.deleteFiliere');

    // Attribution de filières
    Route::post('/assign', [AdminController::class, 'assignFiliereToEtablissement'])->name('admin.assignFiliere');
});

