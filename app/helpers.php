<?php
use Carbon\Carbon;
use Illuminate\Support\Arr;
use App\Models\{Media, Parametre, Produit, Categorie, Commande};
use Illuminate\Support\Facades\Storage;
use Mediumart\Orange\SMS\SMS;
use Mediumart\Orange\SMS\Http\SMSClient;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Http;
use App\Notification\Notification;
use NumberToWords\NumberToWords;
use Illuminate\Support\Facades\Auth;

function isRoot(){
	return (Auth::user()->id_utilisateur <= 2) ? true:false;
	//return (Auth::user()->login == 'doukoure@evil.com' OR Auth::user()->login == 'donzo@evil.com');
}

function html_to_text($html){
	$html = new \Html2Text\Html2Text($html);

	return $html->getText();  // Hello, "WORLD"
}

function image_url($image){
	return asset(Storage::url($image));
}

function evenements(){
	return produits_disponible()->whereTicket(true)->whereDate('date_evenement', '>=', date('Y-m-d H:i'))->orderBy('date_evenement')->get();
}

function clean_empty_cart(){

	Commande::whereNotIn('id_commande', function ($query){
		$query->from('ligne_commande')->select('id_commande')->get();
	})->delete();
}

function enabled_categorie(){
	return Categorie::whereEnabled(true);
}

function sendClearNotification($token = "/topics/utilisateurs"){

	$push = new Notification($token);

	$push->setData([
		'clean_cache' => true
	])->sendNotification();
}

function nextProduct($produit){
	
	return Produit::where('id_produit', '>', $produit->id_produit)->orderBy('id_produit','ASC');
}

function produits_disponible(){
	return Produit::whereEtat(2)->whereIn('id_categorie', function ($query){
		$query->from('categorie')->where('enabled', true)->select('id_categorie')->get();
	})->whereStock(true);

	//->where('prix_vente', '>', 0)
}

function format_phone_number($phone){
	return Propaganistas\LaravelPhone\PhoneNumber::make($phone)->formatInternational();
}

function geocoding($lat, $lng){
	$geocoder = new \OpenCage\Geocoder\Geocoder('f573396a138d4f50b7506a389eca511f');
    $result = $geocoder->geocode("$lat, $lng"); # latitude,longitude (y,x)
    return collect([
    	$result['results'][0]['formatted'],
    	$result['results'][0]['components']['suburb']
    ])->join(', ');
}

function clear_image_directorie($classe, $path = 'public/media'){
	$deletes = collect();
    $files = collect(Storage::allFiles($path));

    foreach ($files as $key => $file) {
       	if (!$classe::whereImage($file)->exists() AND $file != $path.'/default.jpg') {
            $deletes->push($file);
       	}
    }

    Storage::delete($deletes->all());
}

function generate_code($n = 8) {  
    $generator = "1357902468";
  
    $result = ""; 
  
    for ($i = 1; $i <= $n; $i++) { 
        $result .= substr($generator, (rand()%(strlen($generator))), 1); 
    } 
    // Return result 
    return $result; 
}

function categorie_color(){
	return Arr::random([
		'green',
		'red',
		'blue',
		'orange'
	]);
}

function produit_tags(){
	return [
		'Nouvel arrivage',
		'Top collection',
		'Top enfant'
	];
}

function languages(){
	return [
		'fr' => trans("Francais"),
		'en' => trans("English")
	];
}

function models(){
	return [
		// 'utilisateur',
		// 'region',
		// 'commune',
		// 'adresse',
		// 'categorie',
		// 'vendre',
		//'produit',
		// 'image_produit',
		// 'commande'
		// 'ligne_commande',
		// 'propriete',
		// 'caracterise',
		// 'article',
		// 'partenaire',
		// 'parametre',
		// 'media'
	];
}

function parametres(){
	return  [
		
	];
}

function type_utilisateur(){
	return [
		1 => trans("Administrateur"),
		2 => trans("Commercial"),
		3 => trans("Livreur"),
		4 => trans("Fournisseur"),
		5 => trans("Client"),
		6 => trans("Promoteur"),
		7 => trans("Organisateur d'événement")
	];
}

function mode_paiement(){
	return [
		1 => 'Cash a la livraison',
		2 => 'Orange Money',
		3 => 'Mobile Money'
	];
}

function action_commande($etat){
	$message = "Aucune action necessaire";
	switch ($etat) {
		case 1:
			$message = "Valider la commande";
			break;
		case 2:
			$message = "Assigner la commade a un livreur";
			break;
		case 3:
			$message = "Marquer la commade comme livrer";
			break;
	}

	return $message;
}

function statut_commande(){
	return [
		1 => trans('En attente de validation'),
		2 => trans('En préparation pour la livraison'),
		3 => trans('En cours de livraison'),
		4 => trans('Commande livrée'),
	];
}

function statut_paiement(){
	return [
		1 => trans('En attente de paiement'),
		2 => trans('Commande payée'),
		3 => trans('Annuler')
	];
}

function etat_stock(){
	return [
		true => trans('En stock'),
		false => trans('En ruputre de stock')
	];
}

function statut_produit(){
	return [
		1 => trans('En préparation'),
		2 => trans('En ligne'),
		3 => trans('Hors ligne')
	];
}

function get_etat_stock($type){
	return etat_stock()[$type];
}

function get_statut_produit($type){
	return statut_produit()[$type];
}

function get_type_utilisateur($type){
	return type_utilisateur()[$type];
}

function get_mode_paiement($type){
	return mode_paiement()[$type];
}

function get_statut_commande($type){
	return statut_commande()[$type];
}

function get_statut_paiement($type){
	return statut_paiement()[$type];
}

function number_to_word($number = 0){
	$numberToWords = new NumberToWords();
	$numberTransformer = $numberToWords->getNumberTransformer('fr');

	return $numberTransformer->toWords($number);
}

function dateFormat($date, $type = 'table'){
	if (empty($date)) {
		return "";
	}
 	switch ($type) {
 		case 'table':
 			return Carbon::parse($date)->locale('fr_FR')->isoFormat('LL');
 			break;
 		case 'mysql':
 			return Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
 			break;
 		case 'form':
 			return Carbon::parse($date)->format('d/m/Y');
 			break;
 		case 'isoFormat':
 			if (empty($date)) {
 				return trans("Jamais");
 			}
 			return Carbon::parse($date)->locale('fr_FR')->isoFormat('LLLL');
 			break;
 		case 'human':
 			return Carbon::parse($date)->diffForHumans();
 			break;
 		default:
 			return "";
 			break;
 	}
}

function send_sms($message, $telephone){
	//'mJKb2155AFSFWY97fWT3zxuAXtJG1Em5', 'bcKL7EzPzJKfAmM0'
	try {
		$client = SMSClient::getInstance('mwdWEknX75vocJsSLAHyyRzhlZr5QvcY', 'L7hHIkNmS3Sda5Pb');
		$sms = new SMS($client);
		$sms->message($message)->from('+224627044179')->to($telephone)->send();
		return true;
	} catch (\GuzzleHttp\Exception\ConnectException $e) {
		return false;
	}
}

function generate_otp($n = 6) {
    $generator = "1357902468ABCDEF";
  
    $result = ""; 
  
    for ($i = 1; $i <= $n; $i++) { 
        $result .= substr($generator, (rand()%(strlen($generator))), 1); 
    } 
    // Return result 
    return $result; 
}

function format_form_name($text){
	return preg_replace('#_#', ' ', $text);
}

function get_media($name){
	Media::firstOrCreate(['nom' => $name]);
	return Media::whereNom($name)->first();
}

function get_parametre($name, $json = false){
	Parametre::firstOrCreate(['nom' => $name]);
	if ($json) {
		return Parametre::whereNom($name)->first();
	} else {
		return Parametre::whereNom($name)->first()->valeur;
	}
}

function local_money_format($montant, $symbole = ' GNF'){
    return number_format($montant, 0, ' ', ' ').$symbole;
}

function optimize_image($path){
	$img = storage_path("app/$path");
    try {
        \Tinify\setKey("RMwUrt0pxypvC9IX6y4Mg8FFLTW6HPAw");
        $source = \Tinify\fromFile($img);

       	$source->toFile($img);
    } catch (\Tinify\Exception $e) {
        return false;
    }
}

function resizeImage($img, $cible, $extension, $name)
{
	$save = "storage/$cible/$name.$extension";

	Image::make(Storage::get($img))->resize(600, 600)->save($save, 90);
}

?>