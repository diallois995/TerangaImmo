@extends('layouts.app', ['titre' => 'Liste des annonces'])

@section("admin")
<div class="pagetitle">
    <h1>Annonce <em>{{$annonce->titre}}</em></h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Pages</li>
        <li class="breadcrumb-item active">Contact</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section contact">

    <div class="row gy-4">

      <div class="col-xl-6">

        <div class="row">
          <div class="col-lg-6">
            <div class="info-box card">
              <i class="bi bi-geo-alt"></i>
              <h3>Infos</h3>
              <p>Adresse : {{ $annonce->adresse }}</p>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="info-box card">
              <i class="bi bi-telephone"></i>
              <h3>Infos Sup</h3>
              <p>+1 5589 55488 55<br>+1 6678 254445 41</p>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="info-box card">
              <i class="bi bi-envelope"></i>
              <h3>Description</h3>
              <p>{{$annonce->description}}</p>
            </div>
          </div>
        </div>

      </div>

      <div class="col-xl-6">
        <div class="card p-4">
            <img src="data:image/jpeg;base64,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"alt="Photo Annonce" height="600px">
        </div>

      </div>

    </div>

  </section>
@endsection
