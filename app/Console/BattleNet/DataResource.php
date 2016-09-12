<?php

namespace App\Console\BattleNet;

trait DataResource
{
    protected $locale = [
        'eu' => 'en_GB',
        'kr' => 'ko_KR',
        'tw' => 'zh_TW',
        'us' => 'en_US',
    ];

    protected function formatRace($id)
    {
        foreach ($this->races AS $race) {
            if ($id == $race['id']) {
                return $race['name'];
            }
        }
        return null;
    }

    protected $races = [
        [
            'id' => 1,
            'side' => 'alliance',
            'name' => 'Human',
        ],
        [
            'id' => 2,
            'side' => 'horde',
            'name' => 'Orc'
        ],
        [
            'id' => 3,
            'side' => 'alliance',
            'name' => 'Dwarf'
        ],
        [
            'id' => 4,
            'side' => 'alliance',
            'name' => 'Night Elf'
        ],
        [
            'id' => 5,
            'side' => 'horde',
            'name' => 'Undead'
        ],
        [
            'id' => 6,
            'side' => 'horde',
            'name' => 'Tauren'
        ],
        [
            'id' => 7,
            'side' => 'alliance',
            'name' => 'Gnome'
        ],
        [
            'id' => 8,
            'side' => 'horde',
            'name' => 'Troll'
        ],
        [
            'id' => 9,
            'side' => 'horde',
            'name' => 'Goblin'
        ],
        [
            'id' => 10,
            'side' => 'horde',
            'name' => 'Blood Elf'
        ],
        [
            'id' => 11,
            'side' => 'alliance',
            'name' => 'Draenei'
        ],
        [
            'id' => 22,
            'side' => 'alliance',
            'name' => 'Worgen'
        ],
        [
            'id' => 24,
            'side' => 'neutral',
            'name' => 'Pandaren'
        ],
        [
            'id' => 25,
            'side' => 'alliance',
            'name' => 'Pandaren'
        ],
        [
            'id' => 26,
            'side' => 'horde',
            'name' => 'Pandaren'
        ]
    ];

    protected function formatClass($id)
    {
        foreach ($this->classes AS $class) {
            if ($id == $class['id']) {
                return $class['name'];
            }
        }
        return null;
    }

    protected $classes = [
        [
            'id' => 1,
            'name' => 'Warrior',
        ],
        [
            'id' => 2,
            'name' => 'Paladin',
        ],
        [
            'id' => 3,
            'name' => 'Hunter',
        ],
        [
            'id' => 4,
            'name' => 'Rouge',
        ],
        [
            'id' => 5,
            'name' => 'Priest',
        ],
        [
            'id' => 6,
            'name' => 'Death Knight',
        ],
        [
            'id' => 7,
            'name' => 'Shaman',
        ],
        [
            'id' => 8,
            'name' => 'Mage',
        ],
        [
            'id' => 9,
            'name' => 'Warlock',
        ],
        [
            'id' => 10,
            'name' => 'Monk',
        ],
        [
            'id' => 11,
            'name' => 'Druid',
        ],
        [
            'id' => 12,
            'name' => 'Demon Hunter',
        ],
    ];
}
