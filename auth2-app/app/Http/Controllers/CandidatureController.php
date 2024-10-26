<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Http\Requests\StoreCandidatureRequest;
use App\Http\Requests\UpdateCandidatureRequest;
use App\Models\Concour;
use App\Models\Diplome;
use App\Models\Etablissement;
use App\Models\Filiere;
use App\Models\Niveau;
use App\Models\Pays;
use App\Models\Region;
use App\Models\Specialite;
use App\Models\User;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CandidatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('candidatures.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create($concourId)
    // {
    //     $filieres = Filiere::all();
    //     $specialites = Specialite::all();
    //     $diplomes = Diplome::all();
    //     $etablissements = Etablissement::all();
    //     $niveaux = Niveau::all();
    //     $regions = Region::all();
    //     $villes = Ville::all();
    //     $pays = Pays::all();
    //     $concour = Concour::findOrFail($concourId);

    //     return view('candidatures.create', compact('diplomes', 'etablissements', 'niveaux','regions','villes','pays','filieres','specialites','concour'));
    // }
    public function create($concourId)
    {
        // Récupérer l'utilisateur connecté
        $userEmail = Auth::user()->email;
        $concour = Concour::findOrFail($concourId);
        
        // Vérifier si une candidature existe déjà pour cet utilisateur
        $existingCandidature = Candidature::where('email', $userEmail)->first();
    
        // Si une candidature existe, rediriger vers la page d'édition
        if ($existingCandidature) {
            return redirect()->route('candidatures.edit', [
                'candidature' => $existingCandidature->id,
                'concour' => $concourId // Utiliser l'ID du concours
            ])->with('info', 'Vous avez déjà soumis une candidature pour ce concours. Vous pouvez la modifier.');
        }
    
        // Si aucune candidature n'existe, afficher le formulaire de création
        $filieres = Filiere::all();
        $specialites = Specialite::all();
        $diplomes = Diplome::all();
        $etablissements = Etablissement::all();
        $niveaux = Niveau::all();
        $regions = Region::all();
        $villes = Ville::all();
        $pays = Pays::all();
    
        return view('candidatures.create', compact('diplomes', 'etablissements', 'niveaux', 'regions', 'villes', 'pays', 'filieres', 'specialites', 'concour'));
    }
    
    


    /**
     * Store a newly created resource in storage.
     */

//      public function store(Request $request)
// {
    
//        // Validate the request data
//        $validated = $request->validate([
//         'first_name_fr' => 'required|string|max:255',
//         'first_name_ar' => 'required|string|max:255',
//         'last_name_fr' => 'required|string|max:255',
//         'last_name_ar' => 'required|string|max:255',
//         'gender' => 'required|in:male,female',
//         'national_id' => 'required|string|max:20|unique:candidatures,national_id',
//         'cnic_file' => 'nullable|file|mimes:pdf,jpeg,png',
//         'date_naissance' => 'required|date',
//         'current_profession' => 'required|in:autres,employe,fonctionnaire,professionLiberale',
//         'military_status' => 'nullable|in:oui,non',
//         'military_status_pdf' => 'nullable|file|mimes:pdf,jpeg,png',
//         'ville_id' => 'nullable|exists:villes,id',
//         'region_id' => 'nullable|exists:regions,id',
//         'address_fr' => 'required|string|max:255',
//         'phone' => 'required|string|max:20',
//         'email' => 'required|string|email|max:255|unique:candidatures,email',
//         'diplomes' => 'nullable|array',
//         'diplomes.*.etablissement_id' => 'nullable|exists:etablissements,id',
//         'diplomes.*.name' => 'required|string|max:1000',
//         'diplomes.*.niveau_id' => 'nullable|exists:niveaux,id',
//         'diplomes.*.specialite_id' => 'nullable|exists:specialites,id',
//         'diplomes.*.filiere_id' => 'nullable|exists:filieres,id',
//         'diplomes.*.pays_id' => 'nullable|exists:pays,id',
//         'diplomes.*.year_of_obtention' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
//         'diplomes.*.diploma_file' => 'nullable|file|mimes:pdf,jpeg,png',
//     ]);

//       // Create the Candidature
//        $candidature = Candidature::create([
//         'first_name_fr' => $validated['first_name_fr'],
//         'first_name_ar' => $validated['first_name_ar'],
//         'last_name_fr' => $validated['last_name_fr'],
//         'last_name_ar' => $validated['last_name_ar'],
//         'gender' => $validated['gender'],
//         'national_id' => $validated['national_id'],
//         'cnic_file' => $request->file('cnic_file') ? $request->file('cnic_file')->store('cnic_files') : null,
//         'date_naissance' => $validated['date_naissance'],
//         'current_profession' => $validated['current_profession'],
//         'military_status' => $validated['military_status'],
//         'military_status_pdf' => $request->file('military_status_pdf') ? $request->file('military_status_pdf')->store('military_status_files') : null,
//         'ville_id' => $validated['ville_id'],
//         'region_id' => $validated['region_id'],
//         'address_fr' => $validated['address_fr'],
//         'phone' => $validated['phone'],
//         'email' => $validated['email'],
//     ]);
//     dd($candidature);
//     if (isset($validated['diplomes']) && is_array($validated['diplomes'])) {
//         foreach ($validated['diplomes'] as $diplomeData) {
           
//             $diplomaFilePath = $diplomeData['diploma_file'] ? $diplomeData['diploma_file']->store('diplome_files') : null;

//             $diplome = new Diplome([
//                 'candidature_id' => $candidature->id, 
//                 'name' => $diplomeData['name'],
//                 'etablissement_id' => $diplomeData['etablissement_id'],
//                 'niveau_id' => $diplomeData['niveau_id'],
//                 'specialite_id' => $diplomeData['specialite_id'],
//                 'filiere_id' => $diplomeData['filiere_id'],
//                 'pays_id' => $diplomeData['pays_id'],
//                 'year_of_obtention' => $diplomeData['year_of_obtention'],
//                 'diploma_file' => $diplomaFilePath,
//             ]);

//             $diplome->save();
//         }
//     }
    

//     return redirect()->route('concours.index')->with('success', 'Candidature et diplômes enregistrés avec succès.');
// }

// public function store(Request $request, $concour)
// {
//     // Récupérer l'ID du concours (pas besoin de `findOrFail` si l'ID est déjà passé)
//     $concourId = $concour;

//     // Valider les données du formulaire
//     $validated = $request->validate([
//         'first_name_fr' => 'required|string|max:255',
//         'first_name_ar' => 'required|string|max:255',
//         'last_name_fr' => 'required|string|max:255',
//         'last_name_ar' => 'required|string|max:255',
//         'gender' => 'required|in:male,female',
//         'national_id' => 'required|string|max:70',
//         'cnic_file' => 'nullable|file|mimes:pdf,jpeg,png',
//         'date_naissance' => 'required|date',
//         'current_profession' => 'required|in:autres,employe,fonctionnaire,professionLiberale',
//         'military_status' => 'nullable|in:oui,non',
//         'military_status_pdf' => 'nullable|file|mimes:pdf,jpeg,png',
//         'ville_id' => 'nullable|exists:villes,id',
//         'region_id' => 'nullable|exists:regions,id',
//         'address_fr' => 'required|string|max:255',
//         'phone' => 'required|string|max:20',
//     ]);

//     // Récupérer l'email de l'utilisateur connecté
//     $userEmail = Auth::user()->email;

//     // Créer la candidature
//     $candidature = Candidature::create([
//         'first_name_fr' => $validated['first_name_fr'],
//         'first_name_ar' => $validated['first_name_ar'],
//         'last_name_fr' => $validated['last_name_fr'],
//         'last_name_ar' => $validated['last_name_ar'],
//         'gender' => $validated['gender'],
//         'national_id' => $validated['national_id'],
//         'cnic_file' => $request->file('cnic_file') ? $request->file('cnic_file')->store('cnic_files') : null,
//         'date_naissance' => $validated['date_naissance'],
//         'current_profession' => $validated['current_profession'],
//         'military_status' => $validated['military_status'],
//         'military_status_pdf' => $request->file('military_status_pdf') ? $request->file('military_status_pdf')->store('military_status_files') : null,
//         'ville_id' => $validated['ville_id'],
//         'region_id' => $validated['region_id'],
//         'address_fr' => $validated['address_fr'],
//         'phone' => $validated['phone'],
//         'email' => $userEmail,
//         'concour_id' => $concourId, // Utilise l'ID du concours passé dans l'URL
//     ]);

//     // Rediriger avec un message de succès
//     return redirect()->route('concours.index')->with('success', 'Candidature enregistrée avec succès.');
// }

public function store(Request $request, $concour)
{
    // Récupérer l'ID du concours
    $concourId = $concour;

    // Vérifier si l'utilisateur a déjà postulé à ce concours
    $existingCandidature = Candidature::where('concour_id', $concourId)
        ->where('email', Auth::user()->email)
        ->first();

    if ($existingCandidature) {
        return redirect()->back()->withErrors(['error' => 'Vous avez déjà postulé à ce concours.']);
    }

    // Valider les données du formulaire
    $validated = $request->validate([
        'first_name_fr' => 'required|string|max:255',
        'first_name_ar' => 'required|string|max:255',
        'last_name_fr' => 'required|string|max:255',
        'last_name_ar' => 'required|string|max:255',
        'gender' => 'required|in:male,female',
        'national_id' => 'required|string|max:70',
        'cnic_file' => 'nullable|file|mimes:pdf,jpeg,png|max:2048', // Limite de taille 2MB
        'date_naissance' => 'required|date',
        'current_profession' => 'required|in:autres,employe,fonctionnaire,professionLiberale',
        'military_status' => 'nullable|in:oui,non',
        'military_status_pdf' => 'nullable|file|mimes:pdf,jpeg,png|max:2048', // Limite de taille 2MB
        'ville_id' => 'nullable|exists:villes,id',
        'region_id' => 'nullable|exists:regions,id',
        'address_fr' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
    ]);

    // Récupérer l'email de l'utilisateur connecté
    $userEmail = Auth::user()->email;

    // Gestion des fichiers
    $cnicFilePath = $request->file('cnic_file') ? $request->file('cnic_file')->store('cnic_files', 'public') : null;
    $militaryFilePath = $request->file('military_status_pdf') ? $request->file('military_status_pdf')->store('military_status_files', 'public') : null;

    // Créer la candidature
    $candidature = Candidature::create([
        'first_name_fr' => $validated['first_name_fr'],
        'first_name_ar' => $validated['first_name_ar'],
        'last_name_fr' => $validated['last_name_fr'],
        'last_name_ar' => $validated['last_name_ar'],
        'gender' => $validated['gender'],
        'national_id' => $validated['national_id'],
        'cnic_file' => $cnicFilePath,
        'date_naissance' => $validated['date_naissance'],
        'current_profession' => $validated['current_profession'],
        'military_status' => $validated['military_status'],
        'military_status_pdf' => $militaryFilePath,
        'ville_id' => $validated['ville_id'],
        'region_id' => $validated['region_id'],
        'address_fr' => $validated['address_fr'],
        'phone' => $validated['phone'],
        'email' => $userEmail,
        'concour_id' => $concourId, // Utilise l'ID du concours passé dans l'URL
    ]);

    // Ajouter une entrée dans la table candidature_concour
    DB::table('candidature_concour')->insert([
        'candidature_id' => $candidature->id,  // ID de la candidature créée
        'concour_id' => $concourId,  // ID du concours
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Rediriger avec un message de succès
    return redirect()->route('concours.index')->with('success', 'Candidature enregistrée avec succès.');
}


     

     
    
   

    /**
     * Display the specified resource.
     */
    public function show(Candidature $candidature)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($candidatureId, $concour)
    {
        // Récupérer la candidature et le concours
        $candidature = Candidature::findOrFail($candidatureId);
        $concour = Concour::findOrFail($concour);
    
        // Charger d'autres données nécessaires, comme les listes de filières, spécialités, etc.
        $filieres = Filiere::all();
        $specialites = Specialite::all();
        $diplomes = Diplome::all();
        $etablissements = Etablissement::all();
        $niveaux = Niveau::all();
        $regions = Region::all();
        $villes = Ville::all();
        $pays = Pays::all();
    
        return view('candidatures.edit', compact('candidature', 'concour', 'etablissements', 'niveaux', 'regions', 'villes', 'pays', 'filieres', 'specialites'));
    }
    
    

    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdateCandidatureRequest $request, Candidature $candidature)
    // {
    //     //
    // }

    public function update(Request $request, $candidatureId)
    {
        // Récupérer la candidature à modifier
        $candidature = Candidature::findOrFail($candidatureId);
    
        // Valider les nouvelles données du formulaire
        $validated = $request->validate([
            'first_name_fr' => 'required|string|max:255',
            'first_name_ar' => 'required|string|max:255',
            'last_name_fr' => 'required|string|max:255',
            'last_name_ar' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'national_id' => 'required|string|max:70',
            'cnic_file' => 'nullable|file|mimes:pdf,jpeg,png|max:2048',
            'date_naissance' => 'required|date',
            'current_profession' => 'required|in:autres,employe,fonctionnaire,professionLiberale',
            'military_status' => 'nullable|in:oui,non',
            'military_status_pdf' => 'nullable|file|mimes:pdf,jpeg,png|max:2048',
            'ville_id' => 'nullable|exists:villes,id',
            'region_id' => 'nullable|exists:regions,id',
            'address_fr' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            //'concour_id' => 'required|exists:concours,id', // S'assurer que le concours existe
        ]);
    
        // Gestion des fichiers
        $cnicFilePath = $request->file('cnic_file') ? $request->file('cnic_file')->store('cnic_files', 'public') : $candidature->cnic_file;
        $militaryFilePath = $request->file('military_status_pdf') ? $request->file('military_status_pdf')->store('military_status_files', 'public') : $candidature->military_status_pdf;
    
        // Vérifier si la candidature existe déjà pour ce concours
        $existingCandidature = DB::table('candidature_concour')
            ->where('candidature_id', $candidatureId)
            // ->where('concour_id', $validated['concour_id'])
            ->first();
    
        if ($existingCandidature) {
            return redirect()->back()->with('error', 'Vous avez déjà postulé à ce concours.');
        }
    
        // Mettre à jour la candidature
        $candidature->update([
            'first_name_fr' => $validated['first_name_fr'],
            'first_name_ar' => $validated['first_name_ar'],
            'last_name_fr' => $validated['last_name_fr'],
            'last_name_ar' => $validated['last_name_ar'],
            'gender' => $validated['gender'],
            'national_id' => $validated['national_id'],
            'cnic_file' => $cnicFilePath,
            'date_naissance' => $validated['date_naissance'],
            'current_profession' => $validated['current_profession'],
            'military_status' => $validated['military_status'],
            'military_status_pdf' => $militaryFilePath,
            'ville_id' => $validated['ville_id'],
            'region_id' => $validated['region_id'],
            'address_fr' => $validated['address_fr'],
            'phone' => $validated['phone'],
        ]);
    
        // Ajouter la candidature au concours
        DB::table('candidature_concour')->insert([
            'candidature_id' => $candidatureId,
            'concour_id' => $validated['concour_id'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        // Rediriger avec un message de succès
        return redirect()->route('concours.index', ['candidature' => $candidatureId])
                         ->with('success', 'Candidature mise à jour et ajoutée au concours avec succès.');
    }
    
    
    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidature $candidature)
    {
        //
    }
}
