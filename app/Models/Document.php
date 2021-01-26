<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Document
 * 
 * @property int $id_document
 * @property string $nom
 * @property string $template
 * @property string $slug
 * @property string $variables
 * 
 * @property Collection|Demande[] $demandes
 *
 * @package App\Models
 */
class Document extends Model
{
	protected $table = 'document';
	protected $primaryKey = 'id_document';
	public $timestamps = false;

	protected $fillable = [
		'nom',
		'template',
		'slug',
		'variables',
		'datas'
	];

	public function demandes()
	{
		return $this->hasMany(Demande::class, 'id_document');
	}

	public function variables()
	{
		return explode("\n", $this->variables);
	}

	public function datas()
	{
		return explode("\n", $this->datas);
	}
}
