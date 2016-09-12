<?php 

namespace App\Console\BattleNet;

use Illuminate\Support\Collection;

class ApiCollection extends Collection
{
    public function get($key, $default = null)
    {
        if (! str_contains($key, '.')) {
            return parent::get($key, $default);
        }

        $items = $this->items;

        foreach (explode('.', $key) as $index) {
            if (! array_key_exists($index, $items)) {
                return $default;
            }

            $items = $items[$index];
        }

        return $items;
    }
}
