<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etablissement;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $etablissements = Etablissement::all();
        $selectedEtablissement = null;

        if ($request->has('etablissement_id')) {
            $selectedEtablissement = Etablissement::with('filieres')
                ->find($request->etablissement_id);
        }

        return view('user.index', compact('etablissements', 'selectedEtablissement'));
    }
}
?>