@extends('layouts.app', ['titre' => 'Liste des compte'])

@section("admin")
  <div class="pagetitle">
    <h1>Liste des comptes</h1>
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

            <button onclick="document.location='{{route('user.index', ['bloquer' => 'yes'])}}'" style="float: right;" class="btn btn-primary mt-3">
                <b><i class="fa-sharp fa-solid fa-trash"></i> Bloquer</b>
            </button>

            <button onclick="document.location='{{ route('user.create')}}'" style="float: right;" class="btn btn-primary mt-3 m-3">
               <b>Creer</b>
            </button>

            <h5 class="card-title">Datatables</h5>
            <p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable</p>

            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col">Photo</th>
                  <th scope="col">Prenom</th>
                  <th scope="col">Nom</th>
                  <th scope="col">Adresse</th>
                  <th scope="col">Email</th>
                  <th scope="col">Tel</th>
                  <th scope="col">Etat</th>
                  <th scope="col">Ville</th>
                  <th scope="col">Date Niassance</th>
                  <th scope="col">Nationalite</th>
                  <th scope="col">Créer le</th>
                  <th scope="col">Der Mod.</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>
                            <a href="{{ route('user.show', $user)}}">
                                <img src="images/admin/users/{{ $user->photo }}"
                                 alt="Photo user" width="80px">
                            </a>
                        </td>
                        <td>{{ $user->nom }}</td>
                        <td>{{ $user->prenom }}</td>
                        <td>
                            @if ($user->etat == 1)
                                <i style="color:rgb(17, 35, 236)" class="fa-solid fa-circle-check"></i>
                            @else
                                <i style="color: red" class="fa-solid fa-circle-xmark"></i>
                            @endif
                        </td>
                        <td>{{ $user->adresse }}</td>
                        <td>{{ $user->nationalite->nom }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>
                        <td>
                            <button onclick="document.location='{{ route('user.edit', $user)}}'">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>

                            <form action="{{ route('user.destroy', $user)}}" method="Post" style="display: inline" onsubmit="return confirm('Voulez-vous bien supprimer cette user ?')">
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

            {{ $users->links()}}
            {{-- <!-- End Table with stripped rows --> --}}

          </div>
        </div>

      </div>
    </div>
  </section>
@endsection
