<?php namespace App\Services;

use App;

class SteamService {

	private $endpoint = '';

	public function __construct(){
		$this->endpoint = env('steam_endpoint');
	}

	/*
	 * Get all games
	 */
    public function getAllGames(){

		return self::request();
    }


	/*
	 * Service call
	 */
	private function request($url, $opts = false){

	}


}

?>