<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\IGDBService;
Use App\Games;

class GetAllSeries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'games:download';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download games';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->getGames(0);
    }

    public function getGames($offset){
        $IGDB = new IGDBService;
        $games = $IGDB->getGamesPerPlatform($offset);

        if(count($games->games) > 0){
            $this->parseGames($games);
            $this->getGames($offset + 50);
        }
    }

    public function parseGames($games){

        foreach($games->games as $game) {

            //Check if allready in database
            if(Games::where('igdb_id', '=', $game->id)->first()){
                echo "already in db";
            }else{
                $newGame = new Games;
                $newGame->unique_name = $game->slug;
                $newGame->release_date = $game->release_date;
                $newGame->name = $game->name;
                $newGame->igdb_id = $game->id;

                $newGame->save();
            }

        }
    }

}
