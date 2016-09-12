<?php

namespace App\Console\Commands;

use App\Character;
use Illuminate\Console\Command;

class CharactersListCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'characters:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lists all the characters that are currently being tracked.';

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
        $this->table(['Realm', 'Name', 'Has Data', 'Last updated'], $this->generateData());
    }

    protected function generateData($data = [])
    {
        return Character::select('realm', 'name', 'class', 'updated_at')->get()->map(function ($item) {
            $item->data = $item->class === null ? 'No' : 'Yes';
            unset($item->class);

            $item->time = $item->updated_at->diffForHumans();
            unset($item->updated_at);

            return $item;
        })->sortBy('realm');
    }
}
