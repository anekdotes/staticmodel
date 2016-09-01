<?php

namespace Tests;

use Anekdotes\Database\StaticModel;

class Testers extends StaticModel
{
    public static $data = [
        [
            'id' => 1,
            'category' => 'cat 1',
            'en' => [
                'title' => 'foo 1 en'
            ],
            'fr' => [
                'title' => 'foo 1 fr'
            ],
        ],
        [
            'id' => 2,
            'category' => 'cat 2',
            'en' => [
                'title' => 'foo 2 en'
            ],
            'fr' => [
                'title' => 'foo 2 fr'
            ],
        ],
        [
            'id' => 3,
            'category' => 'cat 1',
            'en' => [
                'title' => 'foo 3 en'
            ],
            'fr' => [
                'title' => 'foo 3 fr'
            ],
        ],
    ];
}
