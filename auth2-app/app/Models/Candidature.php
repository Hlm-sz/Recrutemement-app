<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'first_name_fr',
        'first_name_ar',
        'last_name_fr',
        'last_name_ar',
        'gender',
        'national_id',
        'date_naissance',
        'cnic_file',
        'current_profession',
        'military_status',
        'military_status_pdf',
        'ville_id',
        'region_id',
        'address_fr',
        'phone',
        'email',
        'status', 
        ];

    public function diplomes()
    {
    return $this->hasMany(Diplome::class);
    }
    
    public function etablisement()
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

