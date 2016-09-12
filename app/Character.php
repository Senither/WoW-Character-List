<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Character extends Model
{
    protected $fillable = ['name', 'realm'];

    public static function all($columns = [])
    {
        return self::where('avatar', '!=', NULL)
                   ->get()->sortByDesc('ilvl_equipd');
    }

    public function getFullNameAttribute()
    {
        $s = '<span class="character-title">';
        $e = '</span>';

        return $s . sprintf($this->title, $e . $this->name . $s) . $e;
    }

    public function render()
    {
        return view('partial.character', [
            'character' => $this,
            'region'    => mb_strtolower(config('wow.region'))
        ]);
    }
}
