<?php

/*
 * This file is part of the Mailer package.
 *
 * (c) Anekdotes Communication inc. <info@anekdotes.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests;

use Anekdotes\Database\StaticModel;
use PHPUnit_Framework_TestCase;

class StaticModelTest extends PHPUnit_Framework_TestCase
{
    public function testStaticModel1()
    {
        $this->assertEmpty(StaticModel::$data);
    }

    public function testStaticModel2()
    {
        $dummies = [
            [
                'id'    => 1,
                'title' => 'foo 1',
            ],
            [
                'id'    => 2,
                'title' => 'foo 2',
            ],
            [
                'id'    => 3,
                'title' => 'foo 3',
            ],
        ];
        StaticModel::$data = $dummies;
        $this->assertEquals(StaticModel::$data, $dummies);
    }

    public function testStaticModel3()
    {
        $dummies = [
            [
                'id'    => 1,
                'title' => 'foo 1',
            ],
            [
                'id'    => 2,
                'title' => 'foo 2',
            ],
            [
                'id'    => 3,
                'title' => 'foo 3',
            ],
        ];
        StaticModel::$data = $dummies;
        $this->assertNull(StaticModel::find(4));
    }

    public function testStaticModel4()
    {
        $this->assertNull(StaticModel::find(4));
    }

    public function testStaticModel5()
    {
        $dummies = [
            [
                'id'    => 1,
                'title' => 'foo 1',
            ],
            [
                'id'    => 2,
                'title' => 'foo 2',
            ],
            [
                'id'    => 3,
                'title' => 'foo 3',
            ],
        ];
        StaticModel::$data = $dummies;
        $this->assertNotNull(StaticModel::find(3));
    }

    public function testStaticModel6()
    {
        $dummies = [
            [
                'id'    => 1,
                'title' => 'foo 1',
            ],
            [
                'id'    => 2,
                'title' => 'foo 2',
            ],
            [
                'id'    => 3,
                'title' => 'foo 3',
            ],
        ];
        StaticModel::$data = $dummies;
        $goody = StaticModel::find(3);
        $this->assertEquals($goody->id, 3);
    }

    public function testStaticModel7()
    {
        $dummies = [
            [
                'id'    => 1,
                'title' => 'foo 1',
            ],
            [
                'id'    => 2,
                'title' => 'foo 2',
            ],
            [
                'id'    => 3,
                'title' => 'foo 3',
            ],
        ];
        StaticModel::$data = $dummies;
        $goody = StaticModel::find(3);
        $this->assertEquals($goody->title, 'foo 3');
    }

    public function testStaticModel8()
    {
        $dummies = [
            [
                'id'    => 1,
                'title' => 'foo 1',
            ],
            [
                'id'    => 2,
                'title' => 'foo 2',
            ],
            [
                'id'    => 3,
                'title' => 'foo 3',
            ],
        ];
        StaticModel::$data = $dummies;
        $goody = StaticModel::all();
        $this->assertEquals(count($goody), 3);
    }

    public function testStaticModel9()
    {
        StaticModel::$data = [];
        $goody = StaticModel::all();
        $this->assertEquals(count($goody), 0);
    }

    public function testStaticModel11()
    {
        $dummies = [
            [
                'id'    => 1,
                'title' => 'foo 1',
            ],
            [
                'id'    => 2,
                'title' => 'foo 2',
            ],
            [
                'id'    => 3,
                'title' => 'foo 3',
            ],
        ];
        StaticModel::$data = $dummies;
        $goody = StaticModel::find(2);
        $this->assertEquals($goody->getAttribute('title'), 'foo 2');
    }

    public function testStaticModel12()
    {
        $dummies = [
            [
                'id' => 1,
                'fr' => [
                  'title' => 'foo 1 fr',
                ],
                'en' => [
                  'title' => 'foo 1 en',
                ],
            ],
            [
                'id' => 2,
                'fr' => [
                  'title' => 'foo 2 fr',
                ],
                'en' => [
                  'title' => 'foo 2 en',
                ],
            ],
        ];
        StaticModel::$data = $dummies;
        $goody = StaticModel::find(2);
        $this->assertEquals($goody->getAttribute('title'), 'foo 2 fr');
    }

    public function testStaticModel13()
    {
        $dummies = [
            [
                'id' => 1,
                'fr' => [
                  'title' => 'foo 1 fr',
                ],
                'en' => [
                  'title' => 'foo 1 en',
                ],
            ],
            [
                'id' => 2,
                'fr' => [
                  'title' => 'foo 2 fr',
                ],
                'en' => [
                  'title' => 'foo 2 en',
                ],
            ],
        ];
        StaticModel::$data = $dummies;
        $goody = StaticModel::find(2);
        $goody->locale = 'en';
        $this->assertEquals($goody->getAttribute('title'), 'foo 2 en');
    }

    public function testStaticModel14()
    {
        $dummies = [
            [
                'id' => 1,
                'fr' => [
                  'title' => 'foo 1 fr',
                ],
                'en' => [
                  'title' => 'foo 1 en',
                ],
            ],
            [
                'id' => 2,
                'fr' => [
                  'title' => 'foo 2 fr',
                ],
                'en' => [
                  'title' => 'foo 2 en',
                ],
            ],
        ];
        StaticModel::$data = $dummies;
        $goody = StaticModel::find(2);
        $this->assertNull($goody->getAttribute('foo'));
    }

    public function testStaticModel15()
    {
        $dummies = [
            [
                'id'   => 1,
                'city' => 'Montreal',
            ],
            [
                'id'   => 2,
                'city' => 'Quebec',
            ],
        ];
        StaticModel::$data = $dummies;
        $goody = StaticModel::find(2);
        $goody->setAttribute('city', 'Brossard');
        $this->assertEquals($goody->getAttribute('city'), 'Brossard');
    }

    public function testStaticModel16()
    {
        $dummies = [
            [
                'id'   => 1,
                'city' => 'Montreal',
            ],
            [
                'id'   => 2,
                'city' => 'Quebec',
            ],
        ];
        StaticModel::$data = $dummies;
        $goody = StaticModel::find(2);
        $expected = '{"id":2,"city":"Quebec"}';
        $this->assertEquals($goody->toJson(), $expected);
    }

    public function testStaticModel17()
    {
        $dummies = [
            [
                'id'   => 1,
                'city' => 'Montreal',
            ],
            [
                'id'   => 2,
                'city' => 'Quebec',
            ],
        ];
        StaticModel::$data = $dummies;
        $expected = '[{"id":1,"city":"Montreal"},{"id":2,"city":"Quebec"}]';
        $this->assertEquals(StaticModel::allJson(), $expected);
    }

    public function testStaticModel18()
    {
        $dummies = [
            [
                'id'    => 1,
                'title' => 'foo 1',
            ],
            [
                'id'    => 2,
                'title' => 'foo 2',
            ],
            [
                'id'    => 3,
                'title' => 'foo 3',
            ],
        ];
        StaticModel::$data = $dummies;
        $goody = StaticModel::where('title', '=', 'banane');
        $this->assertEmpty($goody);
    }

    public function testStaticModel19()
    {
        $dummies = [
            [
                'id'    => 1,
                'title' => 'foo 1',
            ],
            [
                'id'    => 2,
                'title' => 'foo 2',
            ],
            [
                'id'    => 3,
                'title' => 'foo 3',
            ],
        ];
        StaticModel::$data = $dummies;
        $goody = StaticModel::where('title', '=', 'foo 1')[0];
        $this->assertEquals($goody['id'], 1);
    }

    // public function testStaticModel11()
    // {
    //     $dummies = [
    //         [
    //             'id' => 1,
    //             'fr' => [
    //               'title' => 'foo 1 fr',
    //             ],
    //             'en' => [
    //               'title' => 'foo 1 en',
    //             ]
    //         ],
    //         [
    //             'id' => 2,
    //             'fr' => [
    //               'title' => 'foo 2 fr',
    //             ],
    //             'en' => [
    //               'title' => 'foo 2 en',
    //             ]
    //         ],
    //         [
    //             'id' => 3,
    //             'fr' => [
    //               'title' => 'foo 3 fr',
    //             ],
    //             'en' => [
    //               'title' => 'foo 3 en',
    //             ]
    //         ]
    //     ];
    //     StaticModel::$data = $dummies;
    //     $goody = StaticModel::where('title', '=', 'foo 1');
    //     $this->assertEquals($goody->id, 1);
    // }
}
