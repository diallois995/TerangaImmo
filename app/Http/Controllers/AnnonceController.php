<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AnnonceFormRquest;

class AnnonceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!isset($_GET['corbeille'])) {
            $annonces =  Annonce::where('etat', 1)->paginate(2);
            return view("pages/admin/annonce/liste", compact('annonces'));
        }
        else
        {
            $annonces =  Annonce::where('etat', 0)->paginate(2);
            return view("pages/admin/annonce/corbeille", compact('annonces'));
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
        return view("pages/admin/annonce/add", compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnnonceFormRquest $request)
    {
        // uploading photo
        $nomPhoto = $_FILES['photo']['name'];
        $request->photo->move(public_path('./images/admin/annonces'), $nomPhoto);

        // Persistance des données
        Annonce::create([
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

        return redirect(route('annonce.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Annonce $annonce)
    {
        if (!isset($_GET["afficherPageDetail"])) {
            return view('pages/admin/annonce/show', compact('annonce'));
        }
        else
        {
            $annonces =  Annonce::all();
            return view('pages/vitrine/detail', compact('annonce', 'annonces'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Annonce $annonce
     * @return \Illuminate\Http\Response
     */
    public function edit(Annonce $annonce)
    {
         $categories = Categorie::all();
        return view("pages/admin/annonce/edit", compact('categories', 'annonce'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AnnonceFormRquest $request, Annonce $annonce)
    {
        // uploading photo
        if ($_FILES['photo']['name'] != "") {
            $nomPhoto = $_FILES['photo']['name'];
            $request->photo->move(public_path('./images/admin/annonces'), $nomPhoto);
        }
        else
        {
            $nomPhoto = $annonce->photo;
        }

        // Persistance des données
        $annonce->update([
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

        return redirect(route('annonce.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Annonce $annonce, Request $request)
    {
        if (isset($request->action)) {
            $annonce->destroy($annonce->id);
        }
        else
        {
            if ($annonce->etat == 0) {

                $annonce->update([
                    'etat' => 1,  
                    "updated_by" => Auth::user()->id,
                ]);
            }
            else
            {
                $annonce->update([
                    'etat' => 0,
                    "updated_by" => Auth::user()->id,
                ]);
            }
        }


        return redirect(route('annonce.index'));
    }
}
