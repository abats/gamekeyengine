<?php

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use App\Games;
use Dingo\Api\Routing\Helpers;

class GamesController extends Controller
{
    use Helpers;

    public function index()
    {

    }

    public function getRandom()
    {
        return response()->json(Games::all()->random(12));
    }

    public function search($query){
        return response()->json(Games::where('name', 'LIKE', '%'.$query.'%')->get());
    }

    public function top(){
        return response()->json(Games::where('release_date', '>', '2016-01-01')
            ->where('release_date', '<', date("Y-m-d"))->get()->random(12));
    }



}
