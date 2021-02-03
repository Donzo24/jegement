<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Document};
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\{DocumentCreateRequest, DocumentUpdateRequest};
use App\Gestions\GestionDocument;
use Illuminate\Support\Str;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('document', [
            'documents' => Auth::user()->demandes()->paginate(10),
            'form' => 'forms.document.create'
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
    public function store(DocumentCreateRequest $request, GestionDocument $gestion)
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
        $doc = Document::whereSlug($id)->first();

        return view('demande', [
            'document' => $doc,
            'demandes' => $doc->demandes()->orderBy('date_creation', 'DESC')->paginate(15),
            'form' => 'forms.demande.create'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('document', [
            'documents' => Auth::user()->demandes()->paginate(10),
            'form' => 'forms.document.edit',
            'document_update' => Document::whereSlug($id)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DocumentUpdateRequest $request, GestionDocument $gestion, $id)
    {
        return redirect('documents')->with('info', $gestion->update($request, $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(GestionDocument $gestion, $id)
    {
        return response()->json([
            'status' => $gestion->delete($id),
        ]);
    }
}
