<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concour extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_concour',
        'date_concour',
        'date_affichage',
        'date_limite_depot_dossier',
        'nombre_poste',
        'concour_pdf',
        'statut',
        'administration_id',
        'profil_id',
        'grade_id',
        'filiere_id',
        'resultats_pdf_1',
        'resultats_pdf_2',
        'resultats_pdf_3',
        // 'specialite_id',
    ];
    const STATUS_UPCOMING = 'A venir';
    const STATUS_OPEN = 'Ouvert';
    const STATUS_CLOSED = 'Fermer';

    public function administration()
    {
        return $this->belongsTo(Administration::class);
    }

    public function profil()
    {
        return $this->belongsTo(Profil::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    // public function specialite()
    // {
    //     return $this->belongsTo(Specialite::class);
    // }

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    public function specialites()
{
    return $this->belongsToMany(Specialite::class, 'concour_specialite');
}
public function specialite()
{
    return $this->belongsToMany(Specialite::class);
}

}
