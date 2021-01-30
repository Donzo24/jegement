<?php
namespace App\Gestions;

use App\Models\{Parametre, Utilisateur};
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
/**
 * Gestion des labo
 */
class GestionCompte
{

	public function profil($data)
	{

		Auth::user()->update([
			'nom' => $data->nom,
            'login' => $data->login
		]);

		return trans("Profil modifier avec succes");
	}

	public function password($data)
	{
		Auth::user()->update([
			'password' => Hash::make($data->password),
		]);

		return trans("Mot de passe modifier avec succes");
	}
}
?>