<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etablissement extends Model
{
    use HasFactory;
    protected $fillable = ['id','name'];

    public function candidatures()
    {
        return $this->hasMany(Candidature::class);
    }
}
