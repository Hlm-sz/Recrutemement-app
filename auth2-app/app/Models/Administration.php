<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administration extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function concours()
    {
        return $this->hasMany(Concour::class);
    }
}
