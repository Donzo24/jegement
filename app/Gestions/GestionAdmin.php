<?php
namespace App\Gestions;
/**
 * Gestion categorie
 */

use App\Models\{Utilisateur};
use Illuminate\Support\Str;
use App\Mail\CreateUserAdmin;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;


class GestionAdmin
{
	
	public function store($data)
	{
		$user = Utilisateur::create($data->all());

		$user->update([
			'password' => Hash::make($data->password),
		]);
		
		return trans('Utilisateur creer avec success');
	}

	public function update($data, $key)
	{
		$user = Utilisateur::find($key);

        $user->update($data->all());

		return $user->id_utilisateur;
	}

	public function delete($key)
	{
		Utilisateur::find($key)->delete();
		return true;
	}
}

?>