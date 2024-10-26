<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    use HasFactory;

    protected $fillabel = ['id','name','region_id'];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
