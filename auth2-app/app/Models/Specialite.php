<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialite extends Model
{
    use HasFactory;
    protected $fillable = ['id','name'];

    // public function concours()
    // {
    //     return $this->hasMany(Concour::class);
    // }

    public function concours()
{
    return $this->belongsToMany(Concour::class, 'concour_specialite');
}


    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }
}
