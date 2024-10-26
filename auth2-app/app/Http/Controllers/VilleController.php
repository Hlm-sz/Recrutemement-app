<?php

namespace App\Http\Controllers;

use App\Models\Ville;
use Illuminate\Http\Request;

class VilleController extends Controller
{
    public function getVilles($regionID)
    {
        // Vérifiez que $regionID est bien utilisé pour récupérer les villes
        $villes = Ville::where('region_id', $regionID)->pluck('name', 'id');
        return response()->json($villes);
    }
}
