<?php
namespace App\Gestions;

use App\Models\{Document, Demande};
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
/**
 * Gestion des labo
 */
class GestionDemande
{

	public function store($data)
	{

		$collection = collect($data->all());

		$filtered = $collection->filter(function ($value, $key) {
    		return ($key != "_token" AND $key != "operation" AND $key != "demande");
		});

		Demande::create([
			'id_utilisateur' => Auth::user()->id_utilisateur,
			'id_document' => $data->document,
			'variables' => $filtered->toJson(),
			'date_creation' => now()
		]);

		return trans("Demande creer avec succes");
	}

	public function update($data, $id)
	{
		
	}

	public function delete($id)
	{
		
		return true;
	}
}
?>