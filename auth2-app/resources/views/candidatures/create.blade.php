@extends('layouts.auth')
@section('authcontent')
<div class="container-xxl flex-grow-1 container-p-y">
            
            <!-- Basic Layout -->
            <div class="row">
              <div class="col-xl">
                <div class="card mb-4">
                  <div class="card-header d-flex justify-content-between align-items-center ">
                    <h4 class="mb-0">Informations personnelles </h4>
                    <small class="text-muted float-end">Remplire tous les champs</small>

                  </div>
                  <div class="card-body">
                      
                    <form action="{{route('candidatures.store', ['concour' => $concour->id])}}" method="post" enctype="multipart/form-data">
                    @csrf 
                      <div class="row">
                      <div class="mb-3 col-12 col-md-6">
                        <label class="form-label" for="basic-default-fullname">Prénom</label>
                        <input type="text" class="form-control" id="basic-default-fullname" placeholder="" name="first_name_fr" value="{{ old('first_name_fr') }}"/>
                      </div>
                      <div class="mb-3 col-12 col-md-6">
                        <label class="form-label" for="basic-default-company">الاسم الشخصي</label>
                        <input type="text" class="form-control" id="basic-default-company" placeholder="" name="first_name_ar" value="{{ old('first_name_ar') }}" />
                      </div>
                      </div>
                      <div class="row">
                          <div class="mb-3 col-12 col-md-6">
                            <label class="form-label" for="basic-default-fullname">Nom de famille</label>
                            <input type="text" class="form-control" id="basic-default-fullname" placeholder="" name="last_name_fr" value="{{ old('last_name_fr') }}" />
                          </div>
                          <div class="mb-3 col-12 col-md-6">
                            <label class="form-label" for="basic-default-company">الاسم العائلي</label>
                            <input type="text" class="form-control" id="basic-default-company" placeholder="" name="last_name_ar" value="{{ old('last_name_ar') }}"/>
                          </div>
                      </div>
                      <div class="row">
                          <div class="mb-3 col-12 col-md-3">
                              <input type="radio" id="defaultRadio1" name="gender" value="male" />
                              <label for="defaultRadio1">Masculin / ذكر</label>

                              <input type="radio" id="defaultRadio2" name="gender" value="female" />
                              <label for="defaultRadio2">Féminin / أنثى</label>
                            </div>
                      </div>
                      <div class="row">
                          <div class="mb-3 col-12 col-md-4">
                              <label class="form-label" for="basic-default-company">Cin</label>
                              <input type="text" class="form-control" id="basic-default-company" placeholder="CIN" name="national_id" value="{{ old('national_id') }}" />
                            </div>
                            <div class="mb-3 col-12 col-md-4">
                              <label for="formFile" class="form-label">Téléchargez une copie (PDF)</label>
                              <input class="form-control" type="file" id="formFile" name="cnic_file" accept="application/pdf"/>
                            </div>
                            <div class="mb-3 col-12 col-md-4">
                              <label for="formDate" class="form-label">Date de naissance</label>
                              <input class="form-control" type="date" id="formDate" name="date_naissance" value="{{ old('date_naissance') }}"/>
                            </div>
                      </div>
                      <div class="row">
                          <div class="mb-3 col-12 col-md-4">
                              <label for="exampleFormControlSelect1" class="form-label">Profession actuelle</label>
                              <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="current_profession">
                                <option selected>Selectioner une profession</option>
                                <option value="autres" {{ old('current_profession') == 'autres' ? 'selected' : '' }}>Autres</option>
                                <option value="employe" {{ old('current_profession') == 'employe' ? 'selected' : '' }}>Employé</option>
                                <option value="fonctionnaire" {{ old('current_profession') == 'fonctionnaire' ? 'selected' : '' }}>Fonctionnaire</option>
                                <option value="professionLiberale" {{ old('current_profession') == 'professionLiberale' ? 'selected' : '' }}>Profession Libérale</option>
                              </select>
                            </div>
                            <div class="mb-3 col-12 col-md-4">
                              <label for="exampleFormControlSelect1" class="form-label">Êtes-vous un ancien militaire ou ancien combattant ?</label>
                              <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="military_status" value="{{ old('current_profession') }}">
                                <option selected value="non" {{ old('military_status') == 'non' ? 'selected' : '' }}>Non</option>
                                <option value="oui" {{ old('military_status') == 'oui' ? 'selected' : '' }}>Oui</option>
                              </select>
                            </div>
                            <div class="mb-3 col-12 col-md-4">
                              <label for="formFile" class="form-label">Téléchargez l'attestation militaire (PDF)</label>
                              <input class="form-control" type="file" id="formFile" accept="application/pdf" name="military_status_pdf" />
                            </div>
                      </div>
                      <h4 class="mb-0">Adresse et Contact</h4>
                      <hr/>
                      <div class="row">
                          <div class="mb-3 col-12 col-md-4">
                              <label for="exampleFormControlSelect1" class="form-label">Région</label>
                              <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="region_id">
                                <option selected >Selectioner une région</option>
                                @foreach($regions as $region)
                                    <option value="{{ $region->id }}" {{ old('region_id') == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="mb-3 col-12 col-md-4">
                              <label for="exampleFormControlSelect1" class="form-label">Ville</label>
                              <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="ville_id">
                                <option selected >Selectioner une ville</option>
                                @foreach($villes as $ville)
                                   <option value="{{ $ville->id }}" {{ old('ville_id') == $ville->id ? 'selected' : '' }}>{{ $ville->name }}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="mb-3 col-12 col-md-4">
                              <label for="formAdresse" class="form-label">Adresse</label>
                              <input class="form-control" type="text" id="formAdresse" name="address_fr" value="{{ old('address_fr') }}"/>
                            </div>
                      </div>
                      <div class="row">
                          <div class="mb-3 col-12 col-md-6">
                              <label for="formTéléphone" class="form-label">Téléphone</label>
                              <input class="form-control" type="number" id="formTéléphone" name="phone" value="{{ old('phone') }}" />
                            </div>
                            <div class="mb-3 col-12 col-md-6">
                              <label for="formE-mail" class="form-label">E-mail</label>
                              <input class="form-control" type="email" id="formE-mail" name="email" value="{{ Auth::user()->email  }}"  placeholder="Votre adresse e-mail" disabled/>

                            </div>
                      </div>
                      @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                      <!-- <h4 class="mb-0">Diplôme</h4>
                      <hr/>
                      <div class="row">
                          <div class="mb-3 col-12 col-md-2">
                              <label for="pays1" class="form-label">Pays</label>
                              <select class="form-select" id="pays" aria-label="pays">
                                <option selected >Selectioner le pays</option>
                                <option value="maroc">Maroc</option>
                              </select>
                            </div>
                            <div class="mb-3 col-12 col-md-4">
                              <label for="formdiplome" class="form-label">Diplome</label>
                              <input class="form-control" type="text" id="formdiplome-mail" />
                            </div>
                            <div class="mb-3 col-12 col-md-2">
                              <label for="formdannee" class="form-label">Année d'optention</label>
                              <input class="form-control" type="text" id="formdannee" />
                            </div>
                            <div class="mb-3 col-12 col-md-4">
                              <label for="formFile" class="form-label">Téléchargez le diplôme (PDF)</label>
                              <input class="form-control" type="file" id="formFile" />
                            </div>
                      </div>
                      <div class="row">
                          <div class="mb-3 col-12 col-md-3">
                              <label for="filiere" class="form-label">Filière</label>
                              <select class="form-select" id="filiere" aria-label="filiere">
                                <option selected >Selectioner la Filiére</option>
                                <option value="f">f</option>
                              </select>
                            </div>
                            <div class="mb-3 col-12 col-md-3">
                              <label for="Specialite" class="form-label">Spécialité</label>
                              <select class="form-select" id="Spécialité" aria-label="Specialite">
                                <option selected >Selectioner la Filiére</option>
                                <option value="f">f</option>
                              </select>
                            </div>
                            <div class="mb-3 col-12 col-md-3">
                              <label for="Niveau" class="form-label">Niveau</label>
                              <select class="form-select" id="Niveau" aria-label="Niveau">
                                <option selected >Selectioner le niveau</option>
                                <option value="f">f</option>
                              </select>
                            </div>
                            <div class="mb-3 col-12 col-md-3">
                              <label for="etablicement" class="form-label">Etablisement</label>
                              <select class="form-select" id="etablicement" aria-label="etablicement">
                                <option selected >Selectioner l'établicement</option>
                                <option value="f">f</option>
                              </select>
                            </div>
                      </div> -->
                      <!-- <h4 class="mb-0">CV</h4>
                      <div class="row">
                          <div class="mb-3 col-12 col-md-4">
                              <label for="formFile" class="form-label">Téléchargez le CV (PDF)</label>
                              <input class="form-control" type="file" id="formFile" />
                            </div>
                      </div> -->
                      <div class="row">
                        <div class="col-1">
                            
                      <button type="submit" class="btn btn-primary">Envoyer</button>
                        </div>
                      </div>
                      
                    </form>
                      
                  </div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
                </div>
              </div>
              
            </div>
          </div>
@endsection

