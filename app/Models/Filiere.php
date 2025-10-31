<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'description'];

    /**
     * Relation Many-to-Many avec les établissements
     */
    public function etablissements()
    {
        return $this->belongsToMany(Etablissement::class, 'etablissement_filiere');
    }

  
}
?>