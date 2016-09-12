<?php

namespace App\Console\Commands;

use App\Character;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CharactersAddCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'characters:add 
                            {name  : The name of the character that should be added} 
                            {realm : The realm the character is located on}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds a character that should be tracked.';

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
        if ($this->exists()) {
            return $this->warn(sprintf(
                'There is already a character called %s on %s in the database!', 
                $this->argument('name'), $this->argument('realm')
            ));
        }

        $character = Character::create($this->characterMap());
        
        if (! $character->exists()) {
            $this->error('An unexpected error occured!');
            $this->error('Please make sure that the SQLite database is setup correctly, or check the logs for more information.');

            return false;
        }

        $this->info(sprintf(
            '%s from %s has been successfuly saved to the database!',
            $this->argument('name'), $this->argument('realm')
        ));
    }

    protected function exists()
    {
        return Character::where($this->characterMap())->exists();
    }

    protected function characterMap()
    {
        return [
            'name'  => $this->argument('name'),
            'realm' => $this->argument('realm'),
        ];
    }
}
