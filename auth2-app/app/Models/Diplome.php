<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diplome extends Model
{
    use HasFactory;
    protected $fillable = ['candidature_id', 'etablissement_id','niveau_id','specialite_id','filiere_id','pays_id','year_of_obtention','diploma_file'];

    public function candidature()
   {
    return $this->belongsTo(Candidature::class);
   }


    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class);
    }

    public function niveau()
    {
        return $this->belongsTo(Niveau::class);
    }

    public function specialite()
    {
        return $this->belongsTo(Specialite::class);
    }

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    public function pays()
    {
        return $this->belongsTo(Pays::class);
    }

}
