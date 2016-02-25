<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\IGDBService;
Use App\Games;

class UpdateGameMeta extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game:meta {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update single game meta data';

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
        $gameId = $this->argument('id');

        $IGDB = new IGDBService;
        $gameData = $IGDB->getGameMeta($gameId);

        //Check if in database
        if($game = Games::where('igdb_id', '=', $gameId)->first()){

            $game->rating = $gameData->game->rating;

            if($gameData->game->cover->id) {
                $downloadCoverUrl = "http://res.cloudinary.com/igdb/image/upload/t_cover_big/" . $gameData->game->cover->id . ".png";
                $ch = curl_init($downloadCoverUrl);
                $fp = fopen('../frontend/img/covers/' . $gameData->game->slug . '.png', 'wb');
                curl_setopt($ch, CURLOPT_FILE, $fp);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_exec($ch);
                curl_close($ch);
                fclose($fp);
            }

            $game->poster = $gameData->game->cover->id . ".png";
            $game->save();

        }else{
            echo "no game to update..";
        }



    }
}
