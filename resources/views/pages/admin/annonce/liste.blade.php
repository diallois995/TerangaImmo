@extends('layouts.app', ['titre' => 'Liste des annonces'])

@section("admin")
  <div class="pagetitle">
    <h1>Liste des annonces</h1>
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

            <button onclick="document.location='{{route('annonce.index', ['corbeille' => 'yes'])}}'" style="float: right;" class="btn btn-primary mt-3">
                <b><i class="fa-sharp fa-solid fa-trash"></i> Corbeille</b>
            </button>

            <button onclick="document.location='{{ route('annonce.create')}}'" style="float: right;" class="btn btn-primary mt-3 m-3">
               <b>Ajouter</b>
            </button>

            <h5 class="card-title">Datatables</h5>
            <p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable</p>

            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col">Photo</th>
                  <th scope="col">Titre</th>
                  <th scope="col">Montant</th>
                  <th scope="col">Etat</th>
                  <th scope="col">Adresse</th>
                  <th scope="col">Catégorie</th>
                  <th scope="col">Créer le</th>
                  <th scope="col">Der Mod.</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($annonces as $annonce)
                    <tr>
                        <td>
                            <a href="{{ route('annonce.show', $annonce)}}">
                                <img src="images/admin/annonces/{{ $annonce->photo }}"
                                 alt="Photo Annonce" width="80px">
                            </a>
                        </td>
                        <td>{{ $annonce->titre }}</td>
                        <td>{{ $annonce->montant }}</td>
                        <td>
                            @if ($annonce->etat == 1)
                                <i style="color:green" class="fa-solid fa-circle-check"></i>
                            @else
                                <i style="color: red" class="fa-solid fa-circle-xmark"></i>
                            @endif
                        </td>
                        <td>{{ $annonce->adresse }}</td>
                        <td>{{ $annonce->categorie->nom }}</td>
                        <td>{{ $annonce->created_at }}</td>
                        <td>{{ $annonce->updated_at }}</td>
                        <td>
                            <button onclick="document.location='{{ route('annonce.edit', $annonce)}}'">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>

                            <form action="{{ route('annonce.destroy', $annonce)}}" method="Post" style="display: inline" onsubmit="return confirm('Voulez-vous bien supprimer cette annonce ?')">
                                @csrf
                                {{ method_field('DELETE')}}

                                <button type="submit">
                                    <i class="fa-sharp fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

              </tbody>
            </table>

            {{ $annonces->links()}}
            {{-- <!-- End Table with stripped rows --> --}}

          </div>
        </div>

      </div>
    </div>
  </section>
@endsection
