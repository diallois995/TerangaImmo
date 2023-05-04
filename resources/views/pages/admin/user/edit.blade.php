@extends('layouts.app', ['titre' => 'Ajouter une annonce'])

@section("admin")
<div class="pagetitle">
    <h1>Modifier l'annonce {{ $annonce->nom}}</h1>

    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Tables</li>
        <li class="breadcrumb-item active">Data</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">

            <h5 class="card-title">Datatables</h5>
            <p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable</p>

            <form method="POST" action="{{ route('annonce.update', $annonce)}}" enctype="multipart/form-data" novalidate>
                @csrf
                {{ method_field('PUT') }}

                {{-- Titre, Montant --}}
                <div class="row mb-3">
                    {{-- Titre --}}
                    <div class="col-md-6">
                        <label for="titre" class="col-md-6 form-label">{{__('Titre')}}</label>
                        <input id="titre" name="titre" type="text" class="form-control @error('titre') is-invalid @enderror" value="{{ old('titre') ?? $annonce->titre }}" required autocomplete="titre">
                        @error('titre')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Montant --}}
                    <div class="col-md-6">
                        <label for="montant" class="col-md-6 form-label">{{__('Montant')}}</label>
                        <input id="montant" name="montant" type="number" class="form-control @error('montant') is-invalid @enderror" value="{{ old('montant') ?? $annonce->montant }}" required autocomplete="montant">
                        @error('montant')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>

                {{-- Adresse, Photo --}}
                <div class="row mb-3">
                    {{-- Adresse --}}
                    <div class="col-md-6">
                        <label for="adresse" class="col-md-6 form-label">{{__('Adresse')}}</label>
                        <input id="adresse" name="adresse" type="text" class="form-control @error('adresse') is-invalid @enderror" value="{{ old('adresse') ?? $annonce->adresse }}" required autocomplete="adresse">
                        @error('adresse')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Photo --}}
                    <div class="col-md-6">
                        <label for="photo" class="col-md-6 form-label">{{__('Photo')}}</label>
                        <input id="photo" name="photo" type="file" class="form-control @error('photo') is-invalid @enderror" value="{{ old('photo')}}" required autocomplete="photo">
                        @error('photo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>

                {{-- Visibilite, Descriptoin --}}
                <div class="row mb-3">
                    {{-- Visibilite --}}
                    <div class="col-md-6">
                        <label for="visibilite" class="col-md-6 form-label">{{__('Visibilite')}}</label>
                        <select name="visibilite" id="visibilite" class="form-control">
                            <option value="1" @if ($annonce->etat ==1) selected @endif>Oui</option>
                            <option value="0" @if ($annonce->etat ==0) selected @endif>Non</option>
                        </select>
                        @error('visibilite')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="col-md-6">
                        <label for="description" class="col-md-6 form-label">{{__('Description')}}</label>
                        <textarea name="description" id="description" rows="1" class="form-control">{{ $annonce->drecription }}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>

                 {{-- Date limite, Categorie --}}
                 <div class="row mb-3">
                    {{-- Date limite --}}
                    <div class="col-md-6">
                        <label for="dateLimite" class="col-md-6 form-label">{{__('Date Limite')}}</label>
                        <input id="dateLimite" name="dateLimite" type="date" class="form-control @error('dateLimite') is-invalid @enderror" value="{{ old('dateLimite') ?? $annonce->date_limite }}" required autocomplete="dateLimite">
                        @error('dateLimite')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Categorie --}}
                    <div class="col-md-6">
                        <label for="categorie" class="col-md-6 form-label">{{__('Categorie')}}</label>
                        <select name="categorie" id="categorie" class="form-control">
                            @foreach ($categories as $categorie)
                                <option @if ($categorie->nom == $annonce->categorie->nom) selected @endif value="{{ $categorie->id}}">{{ $categorie->nom }}</option>
                            @endforeach
                        </select>
                        @error('categorie')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Modifier</button>
                <button type="reset" class="btn btn-danger">Annuler</button>
            </form>

          </div>
        </div>

      </div>
    </div>
  </section>
@endsection
