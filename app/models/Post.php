<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Post extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'posts';

	protected $softDelete = true;

	private static function ConSoSinS($val, $sentence) 
	{
		if ($val > 1) return $val.str_replace(array('(s)','(es)'),array('s','es'), $sentence); 
		else return $val.str_replace('(s)', '', $sentence);
	}

	public static function getDate($dato)
	{
		$time = time() - $dato;

		if ($time <= 0) return 'Ahora';
		else if ($time < 60) return "Hace ".self::ConSoSinS(floor($time), ' Segundo(s)');
		else if ($time < 60*60) return "Hace ".self::ConSoSinS(floor($time/60), ' Minuto(s)');
		else if ($time < 60*60*24) return "Hace ".self::ConSoSinS(floor($time/(60*60)), ' Hora(s)');
		else if ($time < 60*60*24*30) return "Hace ".self::ConSoSinS(floor($time/(60*60*24)), ' Día(s)');
		else if ($time < 60*60*24*30*12) return "Hace ".self::ConSoSinS(floor($time/(60*60*24*30)), ' Mes(es)');
		else return "Hace ".self::ConSoSinS(floor($time/(60*60*24*30*12)), ' Año(s)');
	}
	public static function getUrl($string){

		$change = array(' '=>'-');

		return strtr($string, $change);

	}
	public static function getImage($string)
	{
		$doc = new DOMDocument(); 
		$doc->loadHTML($string);
	//	print_r($string);
		$imageTags = $doc->getElementsByTagName('img'); 
		foreach($imageTags as $tag) 
		{ 
			return $tag->getAttribute('src'); 
		}
	}

	public static function makeSlug($value)
	{
		$change= array('Ñ'=>'n', ' '=>'-', 'ñ'=>'n', '/'=>'', '!'=>'', '¡'=>'', '?'=>'', '¿'=>'', '+'=>'', 'á'=>'a', 'é'=>'e', 'í'=>'i', 'ó'=>'o', 'ú'=>'u', '.'=>'', '~'=>'', ':'=>'', '['=>'', ']'=>'', ','=>'', '.'=>'', '&'=>'', '('=>'', ')'=>'', 'A'=>'a','B'=>'b','C'=>'c','D'=>'d','E'=>'e','F'=>'f','G'=>'g','H'=>'h','I'=>'i','J'=>'j','K'=>'k','L'=>'l','M'=>'m','N'=>'n','O'=>'o','P'=>'p','Q'=>'q','R'=>'r','S'=>'s','T'=>'t','U'=>'u','V'=>'v','W'=>'w','X'=>'x','Y'=>'y','Z'=>'z', 'Á'=>'a','á'=>'a','É'=>'e','é'=>'e','Í'=>'i','í'=>'i','Ó'=>'o','ó'=>'o','Ú'=>'u','ú'=>'u', 'ō'=>'o', 'ö'=>'o', 'ä'=>'a', 'Ä'=>'a','ë'=>'e', 'Ë'=>'e','ū'=>'u','ü'=>'u','Ü'=>'u','ï'=>'i','Ï'=>'i', 'ª'=>'', 'º'=>'', '%'=>'','='=>'','´'=>'','`'=>'',"'"=>'','★'=>'');

		return strtr($value, $change);
	}
	public static $rules = array(
		'post_title' 	=> 'required',
		'post_intro' 	=> 'required',
		'post_content' 	=> 'required',
   	);

   	public static $messages = array(
		'post_title.required' => 'El Titulo es Obligatorio.',
		'post_intro.required' => 'Provea de una Introduccion al Post.',
		'post_content.require' => 'Provea el Resto del Contenido del Post.'
   	);
   	public static function validate($data, $id=null){
		$reglas = self::$rules;
		$reglas['post_title'] = str_replace('id', $id, self::$rules['post_title']);
		$reglas['post_intro'] = str_replace('id', $id, self::$rules['post_intro']);
		$reglas['post_content'] = str_replace('id', $id, self::$rules['post_content']);
		$messages = self::$messages;
		return Validator::make($data, $reglas);
   	}
}