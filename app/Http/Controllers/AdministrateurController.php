<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Categorie, Utilisateur};
use App\Http\Requests\AdminCreateRequest;
use App\Gestions\GestionAdmin;

class AdministrateurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administrateur', [
            'form' => 'forms.administrateur.create',
            'administrateurs' => Utilisateur::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminCreateRequest $request, GestionAdmin $gestion)
    {
        return back()->with('info', $gestion->store($request));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('administrateur', [
            'form' => 'forms.administrateur.edit',
            'administrateurs' => Utilisateur::paginate(10),
            'update' => Utilisateur::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminCreateRequest $request, GestionAdmin $gestion, $id)
    {
        return back()->with('info', trans('Utilisateur modifier avec succes'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(GestionAdmin $gestion, $id)
    {
        return response()->json([
            'status' => $gestion->delete($id),
        ]);
    }
}
