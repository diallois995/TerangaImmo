<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!isset($_GET['corbeille'])) {
            $users =  User::where('etat', 1)->paginate(2);
            return view("pages/admin/user/liste", compact('users'));
        }
        else
        {
            $users =  User::where('etat', 0)->paginate(2);
            return view("pages/admin/user/corbeille", compact('users'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categorie::all();
        return view("pages/admin/user/add", compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserFormRquest $request)
    {
        // uploading photo
        $nomPhoto = $_FILES['photo']['name'];
        $request->photo->move(public_path('./images/admin/users'), $nomPhoto);

        // Persistance des données
        User::create([
            "titre" => $request->titre,
            "description" => $request->description,
            "adresse" => $request->adresse,
            "montant" => $request->montant,
            "date_limite" => $request->dateLimite,
            "photo" => $nomPhoto,
            "video" => "",
            "categorie_id" => $request->categorie,
            "etat" => $request->visibilite,
            "created_by" => Auth::user()->id,
        ]);

        return redirect(route('user.index'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if (!isset($_GET["afficherPageDetail"])) {
            return view('pages/admin/user/show', compact('user'));
        }
        else
        {
            $users =  User::all();
            return view('pages/vitrine/detail', compact('user', 'users'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
         $categories = Categorie::all();
        return view("pages/admin/user/edit", compact('categories', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserFormRquest $request, User $user)
    {
        // uploading photo
        if ($_FILES['photo']['name'] != "") {
            $nomPhoto = $_FILES['photo']['name'];
            $request->photo->move(public_path('./images/admin/users'), $nomPhoto);
        }
        else
        {
            $nomPhoto = $user->photo;
        }

        // Persistance des données
        $user->update([
            "titre" => $request->titre,
            "description" => $request->description,
            "adresse" => $request->adresse,
            "montant" => $request->montant,
            "date_limite" => $request->dateLimite,
            "photo" => $nomPhoto,
            "video" => "",
            "categorie_id" => $request->categorie,
            "etat" => $request->visibilite,
            "updated_by" => Auth::user()->id,
        ]);

        return redirect(route('user.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Request $request)
    {
        if (isset($request->action)) {
            $user->destroy($user->id);
        }
        else
        {
            if ($user->etat == 0) {

                $user->update([
                    'etat' => 1,
                    "updated_by" => Auth::user()->id,
                ]);
            }
            else
            {
                $user->update([
                    'etat' => 0,
                    "updated_by" => Auth::user()->id,
                ]);
            }
        }


        return redirect(route('user.index'));
    }
}
