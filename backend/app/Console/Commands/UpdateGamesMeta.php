<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\IGDBService;
Use App\Games;

class UpdateGamesMeta extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'games:meta';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $randomGamesToUpdate = Games::where('poster', null)->where('release_date', '>', '2015-01-01')->take(100)->get();

        $IGDB = new IGDBService;

        foreach($randomGamesToUpdate as $game) {
            $gameData = $IGDB->getGameMeta($game->igdb_id);

            if(isset($gameData->game->rating)){
                $game->rating = $gameData->game->rating;
            }

            if(isset($gameData->game->cover->id)) {
                $downloadCoverUrl = "http://res.cloudinary.com/igdb/image/upload/t_cover_big/" . $gameData->game->cover->id . ".png";
                $ch = curl_init($downloadCoverUrl);
                $fp = fopen('../frontend/img/covers/' . $gameData->game->slug . '.png', 'wb');
                curl_setopt($ch, CURLOPT_FILE, $fp);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_exec($ch);
                curl_close($ch);
                fclose($fp);
            }

            if(isset($gameData->game->cover->id)) {
                $game->poster = $gameData->game->cover->id . ".png";
            }

            $game->save();
        }
    }
}
