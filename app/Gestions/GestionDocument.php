<?php
namespace App\Gestions;

use App\Models\{Document};
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
/**
 * Gestion des labo
 */
class GestionDocument
{

	public function store($data)
	{
		$doc = Document::create([ 
			'slug' => Str::slug($data->nom), 
			'nom' => $data->nom,
			'variables' => $data->variables,
			'datas' => $data->datas,
			'template' => 'template'
		]);

		if ($data->has('template') AND $data->file('template')->isValid()) {

			$name = $doc->slug."-template";

			$extension = $data->template->extension();

			$path = $data->template->storeAs('public/templates', "$name.$extension", 'local');

			$doc->update([
				'template' => $path,
			]);
		}

		return trans("Doc creer avec succes");
	}

	public function update($data, $id)
	{
		$doc = Document::find($id);

		$doc->update([
			'slug' => Str::slug($data->nom), 
			'nom' => $data->nom,
			'datas' => $data->datas,
			'variables' => $data->variables,
		]);

		if ($data->has('template') AND $data->file('template')->isValid()) {

			$name = $doc->slug."-template";

			$extension = $data->template->extension();

			$path = $data->template->storeAs('public/templates', "$name.$extension", 'local');

			$doc->update([
				'template' => $path,
			]);
		}

		return trans("Document modifier avec succes");
	}

	public function delete($id)
	{
		Document::find($id)->delete();
		return true;
	}
}
?>