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
        $demande = Demande::find($id);
        $template = $demande->document->template;

        $now = dateFormat(json_decode($demande->variables, true)['date_jour'], "mysql");

        if (empty($now)) {
            return back()->with('info', "Date du jour invalide");
        }

        $mois = explode(" ", dateFormat($now))[1];
        $an = number_to_word(explode(" ", dateFormat($now))[2]);
        $jour = number_to_word(explode(" ", dateFormat($now))[0]);

        $date_lettre = ucwords("$jour $mois $an");

        $templateProcessor = new TemplateProcessor(storage_path("app/$template"));

        $templateProcessor->setValue("date_jour", dateFormat($now));

        foreach ($demande->document->datas() as $key => $value) {
            $t = explode(":", $value);
            $templateProcessor->setValue($t[0], $t[1]);
        }

        if (!isset(json_decode($demande->variables, true)['requerant'])) {
            return back()->with('info', "Information du requerant invalide");
        }

        $requerants = explode("/", json_decode($demande->variables, true)['requerant']);
        if (count($requerants) < 3) {
            return back()->with('msg', "Erreur");
        }

        $templateProcessor->setValue("requerant", $requerants[0]);
        $templateProcessor->setValue("profession", $requerants[1]);
        $templateProcessor->setValue("adresse", $requerants[2]);

        $templateProcessor->setValues(json_decode($demande->variables, true));

        if (json_decode($demande->variables, true)['sexe_requerant'] == "Monsieur") {
            $templateProcessor->setValue("genre", "Fils");
            $templateProcessor->setValue("accord_1", " ");
            $templateProcessor->setValue("accord_2", "Le requérant");
            $templateProcessor->setValue("accord_3", "le requérant");
            $templateProcessor->setValue("accord_4", "du requérant");
        }else{
            $templateProcessor->setValue("accord_1", "e");
            $templateProcessor->setValue("accord_2", "La requérante");
            $templateProcessor->setValue("accord_3", "la requérante");
            $templateProcessor->setValue("accord_4", "de la requérante");
            $templateProcessor->setValue("genre", "Fille");
        }

        
        $templateProcessor->setValue("date_lettre", $date_lettre);

        $annee = explode("/", json_decode($demande->variables, true)['date_naissance'])[2];

        $templateProcessor->setValue("annee_naissance", ucwords(number_to_word($annee)));

        $doc_name = json_decode($demande->variables, true)['prenom']." ".json_decode($demande->variables, true)['nom'];

        $templateProcessor->saveAs("$doc_name-jugement-supletif.docx");

        return response()->download(public_path("$doc_name-jugement-supletif.docx"))->deleteFileAfterSend(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $demande = Demande::find($id);

        return view('demande', [
            'demandes' => [],
            'document' => $demande->document,
            'form' => 'forms.demande.edit',
            'update' => $demande
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DemandeCreateRequest $request, GestionDemande $gestion, $id)
    {
        return back()->with('info', $gestion->update($request, $id));
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
