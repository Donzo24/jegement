<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Document, Demande};
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\{DocumentCreateRequest, DemandeCreateRequest};
use App\Gestions\{GestionDocument, GestionDemande};
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

class DemandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(DemandeCreateRequest $request, GestionDemande $gestion)
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
            'demandes' => $doc->demandes()->paginate(15),
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

        $mois = explode(" ", dateFormat(now()))[1];
        $an = number_to_word(explode(" ", dateFormat(now()))[2]);
        $jour = number_to_word(explode(" ", dateFormat(now()))[0]);

        $date_lettre = ucwords("$jour $mois $an");

        $demande = Demande::find($id);
        $template = $demande->document->template;

        $templateProcessor = new TemplateProcessor(storage_path("app/$template"));

        $templateProcessor->setValues(json_decode($demande->variables, true));

        foreach ($demande->document->datas() as $key => $value) {
            $t = explode(":", $value);
            $templateProcessor->setValue($t[0], $t[1]);
        }

        $templateProcessor->setValue("genre", "Fille");

        if (json_decode($demande->variables, true)['sexe'] == "Mr" OR json_decode($demande->variables, true)['sexe'] == "Monsieur") {
            $templateProcessor->setValue("genre", "Fils");
            $templateProcessor->setValue("accord", " ");
        }else{
            $templateProcessor->setValue("accord", "e");
        }

        $templateProcessor->setValue("date_jour", dateFormat(now()));
        $templateProcessor->setValue("date_lettre", $date_lettre);

        $annee = explode("/", json_decode($demande->variables, true)['date_naissance'])[2];

        $templateProcessor->setValue("annee_naissance", ucwords(number_to_word($annee)));

        $doc_name = json_decode($demande->variables, true)['prenom']." ".json_decode($demande->variables, true)['nom'];

        $templateProcessor->saveAs("$doc_name-jugement-supletif.docx");

        return response()->download(public_path("$doc_name-jugement-supletif.docx"))->deleteFileAfterSend(true);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
