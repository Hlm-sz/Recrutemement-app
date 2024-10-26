<?php

namespace App\Http\Controllers;

use App\Models\Concour;
use App\Http\Requests\StoreConcourRequest;
use App\Http\Requests\UpdateConcourRequest;
use App\Models\Administration;
use App\Models\Filiere;
use App\Models\Grade;
use App\Models\Profil;
use App\Models\Specialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConcourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $concours = Concour::with(['administration', 'profil', 'grade', 'specialite','filiere' ])->get();
        
        return view('concours.index', compact('concours'));
       
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $administrations = Administration::all();
        $profils = Profil::all();
        $grades = Grade::all();
        $filieres = Filiere::all();
        $specialites = Specialite::all();
        return view('concours.create', compact('administrations', 'profils', 'grades', 'filieres', 'specialites'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request  $request)
    // {
    //     $validated = $request->validate([
    //         'nom_concour' => 'required|string|max:255',
    //         'date_concour' => 'required|date',
    //         'date_affichage' => 'required|date',
    //         'date_limite_depot_dossier' => 'required|date',
    //         'nombre_poste' => 'required|integer',
    //         'concour_pdf' => 'required|file|mimes:pdf',
    //         'resultats_pdf_1' => 'file|mimes:pdf',
    //         'resultats_pdf_2' => 'file|mimes:pdf',
    //         'resultats_pdf_3' => 'file|mimes:pdf',
    //         'statut' => 'required|string|max:255',
    //         'administration_id' => 'nullable|exists:administrations,id',
    //         'profil_id' => 'nullable|exists:profils,id',
    //         'grade_id' => 'nullable|exists:grades,id',
    //         'filiere_id' => 'nullable|exists:filieres,id',
    //         'specialite_id' => 'nullable|exists:specialites,id',
    //     ]);
    
    //     if ($request->hasFile('concour_pdf')) {
    //         $validated['concour_pdf'] = $request->file('concour_pdf')->store('concours', 'public');
    //     }
    
    //     Concour::create($validated);
    
    //     return redirect()->route('concours.index')->with('success', 'Concours created successfully.');
    
    // }
//     public function store(Request $request)
// {
//     $request->validate([
//         'nom' => 'required|string|max:255',
//         'administration' => 'required|exists:administrations,id',
//         'profile' => 'required|exists:profils,id',
//         'grade' => 'nullable|exists:grades,id',
//         'dateConcours' => 'required|date',
//         'dateLimite' => 'required|date',
//         'filiere' => 'required|exists:filieres,id',
//         'specialite' => 'required|array',
//         'specialite.*' => 'exists:specialites,id',
//         'nombrePostes' => 'required|integer',
//         'dateAffichage' => 'required|date',
//         'concour_pdf' => 'required|file|mimes:pdf|max:2048',
//     ]);

//     // Handle file upload
//     if ($request->hasFile('concour_pdf')) {
//         $filePath = $request->file('concour_pdf')->store('concours');
//     }

//     // Store the data
//     Concour::create([
//         'nom_concour' => $request->nom,
//         'administration_id' => $request->administration,
//         'profil_id' => $request->profile,
//         'grade_id' => $request->grade,
//         'date_concour' => $request->dateConcours,
//         'date_affichage' => $request->dateAffichage,
//         'date_limite_depot_dossier' => $request->dateLimite,
//         'nombre_poste' => $request->nombrePostes,
//         'concour_pdf' => $filePath,
//         'filiere_id' => $request->filiere,
//         'specialite_id' => $request->specialite,
//     ]);

//     return redirect()->route('concours.index')->with('success', 'Concour created successfully.');
// }
public function store(Request $request)
{
    // Valider les données de la requête
    $validated = $request->validate([
        'nom_concour' => 'required|string|max:255',
        'date_concour' => 'required|date',
        'date_affichage' => 'required|date',
        'date_limite_depot_dossier' => 'required|date',
        'nombre_poste' => 'required|integer',
        'concour_pdf' => 'required|file|mimes:pdf',
        'resultats_pdf_1' => 'nullable|file|mimes:pdf',
        'resultats_pdf_2' => 'nullable|file|mimes:pdf',
        'resultats_pdf_3' => 'nullable|file|mimes:pdf',
        'statut' => 'nullable|string|max:255',
        'administration_id' => 'nullable|exists:administrations,id',
        'profil_id' => 'nullable|exists:profils,id',
        'grade_id' => 'nullable|exists:grades,id',
        'filiere_id' => 'nullable|exists:filieres,id',
        'specialite_ids' => 'nullable|array',
        'specialite_ids.*' => 'exists:specialites,id',
    ]);

    // Traiter les fichiers uploadés
    if ($request->hasFile('concour_pdf')) {
        $validated['concour_pdf'] = $request->file('concour_pdf')->store('concours', 'public');
    }

    if ($request->hasFile('resultats_pdf_1')) {
        $validated['resultats_pdf_1'] = $request->file('resultats_pdf_1')->store('concours/results', 'public');
    }

    if ($request->hasFile('resultats_pdf_2')) {
        $validated['resultats_pdf_2'] = $request->file('resultats_pdf_2')->store('concours/results', 'public');
    }

    if ($request->hasFile('resultats_pdf_3')) {
        $validated['resultats_pdf_3'] = $request->file('resultats_pdf_3')->store('concours/results', 'public');
    }

    // Définir un statut par défaut si non fourni
    if (empty($validated['statut'])) {
        $validated['statut'] = 'A venir';
    }

    // Créer le concours
    $concour = Concour::create($validated);

    // Associer les spécialités au concours
    if (!empty($validated['specialite_ids'])) {
        $concour->specialites()->sync($validated['specialite_ids']);
    }

    // Rediriger avec un message de succès
    return redirect()->route('concours.index')->with('success', 'Concours created successfully.');
}



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $concour = Concour::with('specialites')->findOrFail($id);
        return view('concours.show', compact('concour'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $concour = Concour::with('specialites')->findOrFail($id);
        $administrations = Administration::all();
        $profils = Profil::all();
        $grades = Grade::all();
        $filieres = Filiere::all();
        $specialites = Specialite::all();
        return view('concours.edit', compact('concour', 'administrations', 'profils', 'grades', 'filieres', 'specialites'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Concour $concour)
    // {
    //     $validated = $request->validate([
    //         'nom_concour' => 'required|string|max:255',
    //         'date_concour' => 'required|date',
    //         'date_affichage' => 'required|date',
    //         'date_limite_depot_dossier' => 'required|date',
    //         'nombre_poste' => 'required|integer',
    //         'concour_pdf' => 'nullable|file|mimes:pdf',
    //         'resultats_pdf_1' => 'file|mimes:pdf',
    //         'resultats_pdf_2' => 'file|mimes:pdf',
    //         'resultats_pdf_3' => 'file|mimes:pdf',
    //         'statut' => 'required|string|max:255',
    //         'administration_id' => 'nullable|exists:administrations,id',
    //         'profil_id' => 'nullable|exists:profils,id',
    //         'grade_id' => 'nullable|exists:grades,id',
    //         'filiere_id' => 'nullable|exists:filieres,id',
    //         'specialite_id' => 'nullable|exists:specialites,id',
    //     ]);
    
    //     if ($request->hasFile('concour_pdf')) {
    //         // Delete old PDF if exists
    //         if ($concour->concour_pdf) {
    //             Storage::disk('public')->delete($concour->concour_pdf);
    //         }
    
    //         $validated['concour_pdf'] = $request->file('concour_pdf')->store('concours', 'public');
    //     }
    
    //     $concour->update($validated);
    
    //     return redirect()->route('concours.index')->with('success', 'Concours updated successfully.');
    
    // }
    public function update(Request $request, $id)
{
    $concour = Concour::findOrFail($id);

    $validated = $request->validate([
        'nom_concour' => 'required|string|max:255',
        'date_concour' => 'required|date',
        'date_affichage' => 'required|date',
        'date_limite_depot_dossier' => 'required|date',
        'nombre_poste' => 'required|integer',
        'concour_pdf' => 'nullable|file|mimes:pdf',
        'resultats_pdf_1' => 'nullable|file|mimes:pdf',
        'resultats_pdf_2' => 'nullable|file|mimes:pdf',
        'resultats_pdf_3' => 'nullable|file|mimes:pdf',
        'statut' => 'nullable|string|max:255',
        'administration_id' => 'nullable|exists:administrations,id',
        'profil_id' => 'nullable|exists:profils,id',
        'grade_id' => 'nullable|exists:grades,id',
        'filiere_id' => 'nullable|exists:filieres,id',
        'specialite_ids' => 'nullable|array',
        'specialite_ids.*' => 'exists:specialites,id',
    ]);

    

    if ($request->hasFile('concour_pdf')) {
        // Store new file and delete old file if exists
        if ($concour->concour_pdf) {
            Storage::disk('public')->delete($concour->concour_pdf);
        }
        $validated['concour_pdf'] = $request->file('concour_pdf')->store('concours', 'public');
    }

   if ($request->hasFile('resultats_pdf_1')) {
    // Store new file and delete old file if exists
    if ($concour->resultats_pdf_1) {
        Storage::disk('public')->delete($concour->resultats_pdf_1);
    }
    $validated['resultats_pdf_1'] = $request->file('resultats_pdf_1')->store('concours', 'public');
    // dd($validated['resultats_pdf_1']);
}

    

    if ($request->hasFile('resultats_pdf_2')) {
        if ($concour->resultats_pdf_2) {
            Storage::disk('public')->delete($concour->resultats_pdf_2);
        }
        $validated['resultats_pdf_2'] = $request->file('resultats_pdf_2')->store('concours', 'public');
    }

    if ($request->hasFile('resultats_pdf_3')) {
        if ($concour->resultats_pdf_3) {
            Storage::disk('public')->delete($concour->resultats_pdf_3);
        }
        $validated['resultats_pdf_3'] = $request->file('resultats_pdf_3')->store('concours', 'public');
    }

    if (empty($validated['statut'])) {
        $validated['statut'] = 'A venir';
    }

    // Update the concours record
    $concour->update($validated);

    if (!empty($validated['specialite_ids'])) {
        $concour->specialite()->sync($validated['specialite_ids']);
    }

    return redirect()->route('concours.index')->with('success', 'Concours updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Concour $concour)
    {
        if ($concour->concour_pdf) {
            Storage::disk('public')->delete($concour->concour_pdf);
        }
    
        $concour->delete();
    
        return redirect()->route('concours.index')->with('success', 'Concours deleted successfully.');
    }

    public function indexcandidat()
    {
        $concours = Concour::with(['administration', 'profil', 'grade', 'specialite','filiere' ])->get();
        // return view('concours.indexcandidat', compact('concours'));
        return view('welcome', compact('concours'));
    }

    // public function indexcandidatd()
    // {
    //     $concours = Concour::with(['administration', 'profil', 'grade', 'specialite','filiere' ])->get();
    //     // return view('concours.indexcandidat', compact('concours'));
    //     return view('dashboard', compact('concours'));
    // }

    public function indexcandidatd()
    {
    $concours = Concour::with(['administration', 'profil', 'grade', 'specialite', 'filiere'])->get();
    return view('dashboard', compact('concours'));
    }

    public function getSpecialites($filiere_id)
    {
        $specialites = Specialite::where('filiere_id', $filiere_id)->pluck('name', 'id');

        return response()->json($specialites);
    }

}
