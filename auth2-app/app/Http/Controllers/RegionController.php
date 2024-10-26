<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function getCities($region_id)
    {
        $cities = City::where('region_id', $region_id)->pluck('name', 'id');
        return response()->json($cities);
    }
}
