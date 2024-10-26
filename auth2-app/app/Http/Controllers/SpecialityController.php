<?php

namespace App\Http\Controllers;

use App\Models\Speciality;
use Illuminate\Http\Request;

class SpecialityController extends Controller
{
    public function getSpecialitiesByFiliere(Request $request)
    {
        return Speciality::where('filiere_id', $request->filiere_id)->get();
    }
}
