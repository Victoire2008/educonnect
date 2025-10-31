<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etablissement extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'adresse', 'contact']; // ajoute d’autres champs si nécessaire

    /**
     * Relation Many-to-Many avec les filières
     */
    public function filieres()
    {
        return $this->belongsToMany(Filiere::class, 'etablissement_filiere');
    }

}

