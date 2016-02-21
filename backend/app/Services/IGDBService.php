<?php namespace App\Services;

use App;

class IGDBService {

	private $endpoint = '';
	private $key = '';
	private $platform = 6; //windows, linux = 3 ?¿ steamos = 92
	private $limit = 50;

	public function __construct(){
		$this->key = env('IGDB_KEY');
		$this->endpoint = env('IGDB_endpoint');
	}

    private function getToken(){
    	return $this->key;
    }

	/*
	 * Get all games
	 */
    public function getGamesPerPlatform($offset){
		$opts = $array = array(
			"limit" => $this->limit,
			"offset" => $offset
		);

		return self::request('platforms/' . $this->platform . '/games', $opts);
    }

	/*
	 * Get game details
	 */
    public function getGameMeta($gameId){

    }

    /*
     * Search games
     */
	public function searchGames($query, $platforms, $filters){

	}

	/*
	 * Service call
	 */
	private function request($url, $opts = false){
		$url = $this->endpoint . $url;

		if($opts){
			$optUrl = array();
			foreach($opts as $param => $paramValue){
				if($param == "filters"){
					foreach($paramValue as $filter => $filterValue){
						array_push($optUrl, "filters[" . $filter . "]=" . $filterValue);
					}
				} else {
					array_push($optUrl, $param . "=" . $paramValue);
				}
			}
			$url .= "?" . implode("&", $optUrl);
		}

		$url = $url . "&token=" . $this->key;

		$opts = array(
			'http' => array(
				'method' => "GET",
				'header' => "Accept: application/json" .
					"Authorization: Token token=\"" . $this->key . "\""
			)
		);

		$context = stream_context_create($opts);
		$file = file_get_contents($url, false, $context);
		return json_decode($file);
	}


}

?>