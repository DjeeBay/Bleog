<?php
namespace App\MyLibraries;

class VideoTreatment
{
	public static function getIdYoutube($url)
	{
		$idUrl = htmlspecialchars($url);
		$idUrl = str_replace('https://youtu.be/', '', $url);
		$idUrl = str_replace('https://www.youtube.com/watch?v=', '', $url);
		return $idUrl;
	}
}