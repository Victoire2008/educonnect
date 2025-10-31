<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etablissement;
use App\Models\Filiere;

class AdminController extends Controller
{
    //afficher le dashboard admin avec les établissements et filières
    public function index() {
        $etablissements = Etablissement::all();
        $filieres = Filiere::all();
        return view('admin.dashboard',compact('etablissements','filieres'));
    }
    // Ajouter un nouvel établissement
    public function storeetablissement(Request $request)
    {
        $request->validate([
            'nom' => 'required|unique:etablissements,nom',
            'adresse' => 'nullable|string',
            'contact' => 'nullable|string',
        ]);
          Etablissement::create($request->all());
        return back()->with('success', 'Établissement ajouté avec succès !');
    }
     //Ajouter une nouvelle filiere 
      public function storeFiliere(Request $request)
    {
        $request->validate([
            'nom' => 'required|unique:filieres,nom',
        ]);

        Filiere::create($request->all());
        return back()->with('success', 'Filière ajoutée avec succès !');
    }

    // Attribuer des filières à un établissement
    public function assignFiliereToEtablissement(Request $request)
    {
        $request->validate([
            'etablissement_id' => 'required|exists:etablissements,id',
            'filieres' => 'required|array',
        ]);
     $etablissement = Etablissement::findOrFail($request->etablissement_id);

    // On enregistre les associations
    $etablissement->filieres()->syncWithoutDetaching($request->filieres);

    return redirect()->back()->with('success', 'Filières attribuées avec succès.');
}
          
}