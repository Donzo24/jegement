<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class Utilisateur
 * 
 * @property int $id_utilisateur
 * @property string $nom
 * @property string $login
 * @property string $password
 * @property string|null $remember_token
 * 
 * @property Collection|Demande[] $demandes
 *
 * @package App\Models
 */
class Utilisateur extends Authenticatable
{

	use HasFactory, Notifiable;
	
	protected $table = 'utilisateur';
	protected $primaryKey = 'id_utilisateur';
	public $timestamps = false;

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'nom',
		'login',
		'password',
		'remember_token'
	];

	public function demandes()
	{
		return $this->hasMany(Demande::class, 'id_utilisateur');
	}
}
