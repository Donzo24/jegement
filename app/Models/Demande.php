<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Demande
 * 
 * @property int $id_utilisateur
 * @property int $id_document
 * @property string $variables
 * 
 * @property Document $document
 * @property Utilisateur $utilisateur
 *
 * @package App\Models
 */
class Demande extends Model
{
	protected $table = 'demande';
	public $timestamps = false;
	protected $primaryKey = 'id_demande';

	protected $casts = [
		'id_utilisateur' => 'int',
		'id_document' => 'int'
	];

	protected $fillable = [
		'variables',
		'id_document',
		'id_utilisateur',
		'date_creation'
	];

	public function document()
	{
		return $this->belongsTo(Document::class, 'id_document');
	}

	public function utilisateur()
	{
		return $this->belongsTo(Utilisateur::class, 'id_utilisateur');
	}
}
