<?php

namespace App\Console\Commands;

use App\Character;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Console\BattleNet\Client;

class CharactersUpdateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'characters:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates all the WoW characters using the BattleNet API';

    protected $client;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Client $client)
    {
        parent::__construct();

        $this->client = $client;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $characters = $this->characters();

        if ($characters->isEmpty()) {
            return $this->info('No characters are ready to be updated.');
        }

        foreach ($characters AS $character) {
            $this->line(sprintf('Updating %s-%s...', $character->name, $character->realm));

            $this->client->update($character);
        }
    }

    protected function characters()
    {
        $updateRate = config('wow.update-rate', 60 * 12);
        $now        = Carbon::now();

        return Character::get()->filter(function ($value, $key) use ($updateRate, $now) {
            if ($value->avatar == null) {
                return true;
            }
            
            return $value->updated_at->addMinutes($updateRate)->lte($now);
        });
    }
}
