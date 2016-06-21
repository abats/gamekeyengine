<?php namespace App\Services;

use App;
use PhpParser\Node\Expr\Cast\Array_;

class MetacriticService {

	private $endpoint = '';

	public function __construct(){
		$this->endpoint = 'dingdong';
	}

	/*
	 * Find rating for specific game
	 */
    public function findRating(){

		return self::request('url', $array = []);
    }


	/*
	 * Service call
	 */
	private function request($url, $opts = false){

	}


}

?>