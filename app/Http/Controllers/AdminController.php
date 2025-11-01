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

    // Afficher le formulaire de modification
public function editEtablissement($id)
{
    $etablissement = Etablissement::findOrFail($id);
    return view('admin.editEtablissement', compact('etablissement'));
}
    
    // Mettre à jour l'établissement
     public function updateEtablissement(Request $request, $id)
   {
    $request->validate([
        'nom' => 'required|string|unique:etablissements,nom,'.$id,
        'adresse' => 'nullable|string',
        'contact' => 'nullable|string',
    ]);

    $etablissement = Etablissement::findOrFail($id);
    $etablissement->update($request->all());

    return redirect()->back()->with('success', 'Établissement mis à jour avec succès.');
}
   // Supprimer un établissement
public function deleteEtablissement($id)
{
    $etablissement = Etablissement::findOrFail($id);
    $etablissement->delete();

    return redirect()->back()->with('success', 'Établissement supprimé avec succès.');
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

  // Afficher le formulaire de modification
public function editFiliere($id)
{
    $filiere = Filiere::findOrFail($id);
    return view('admin.editFiliere', compact('filiere'));
}

// Mettre à jour la filière
public function updateFiliere(Request $request, $id)
{
    $request->validate([
        'nom' => 'required|string|unique:filieres,nom,'.$id,
        'description' => 'nullable|string',
    ]);

    $filiere = Filiere::findOrFail($id);
    $filiere->update($request->all());

    return redirect()->back()->with('success', 'Filière mise à jour avec succès.');
}

// Supprimer une filière
public function deleteFiliere($id)
{
    $filiere = Filiere::findOrFail($id);
    $filiere->delete();

    return redirect()->back()->with('success', 'Filière supprimée avec succès.');
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
    //syncWithoutDetaching evite les doublons
    $etablissement->filieres()->syncWithoutDetaching($request->filieres);

    return redirect()->back()->with('success', 'Filières attribuées avec succès.');
}
          
}