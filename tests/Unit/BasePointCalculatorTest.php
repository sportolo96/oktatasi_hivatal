<?php

namespace Tests\Unit;

use App\Services\PointCalculator\BasePointCalculator;
use App\Services\PointCalculator\ExtraPointCalculator;
use Tests\TestCase;

class BasePointCalculatorTest extends TestCase
{
    /**
     * Test the base point calculation.
     */
    public function test_correct_base_point_calculator(): void
    {
        $exampleData = [
            'valasztott-szak' => [
                'egyetem' => 'ELTE',
                'kar' => 'IK',
                'szak' => 'Programtervező informatikus',
            ],
            'erettsegi-eredmenyek' => [
                [
                    'nev' => 'magyar nyelv és irodalom',
                    'tipus' => 'közép',
                    'eredmeny' => '70%',
                ],
                [
                    'nev' => 'történelem',
                    'tipus' => 'közép',
                    'eredmeny' => '80%',
                ],
                [
                    'nev' => 'matematika',
                    'tipus' => 'emelt',
                    'eredmeny' => '90%',
                ],
                [
                    'nev' => 'angol nyelv',
                    'tipus' => 'közép',
                    'eredmeny' => '94%',
                ],
                [
                    'nev' => 'informatika',
                    'tipus' => 'közép',
                    'eredmeny' => '95%',
                ],
            ],
        ];

        $calculator = new BasePointCalculator();
        $result = $calculator->calculate($exampleData);
        $this->assertEquals(370, $result);
    }

    /**
     * Test the base point calculation.
     */
    public function test_other_correct_base_point_calculator(): void
    {
        $exampleData = [
            'valasztott-szak' => [
                'egyetem' => 'ELTE',
                'kar' => 'IK',
                'szak' => 'Programtervező informatikus',
            ],
            'erettsegi-eredmenyek' => [
                [
                    'nev' => 'magyar nyelv és irodalom',
                    'tipus' => 'közép',
                    'eredmeny' => '70%',
                ],
                [
                    'nev' => 'történelem',
                    'tipus' => 'közép',
                    'eredmeny' => '80%',
                ],
                [
                    'nev' => 'matematika',
                    'tipus' => 'emelt',
                    'eredmeny' => '90%',
                ],
                [
                    'nev' => 'angol nyelv',
                    'tipus' => 'közép',
                    'eredmeny' => '94%',
                ],
                [
                    'nev' => 'informatika',
                    'tipus' => 'közép',
                    'eredmeny' => '95%',
                ],
                [
                    'nev' => 'fizika',
                    'tipus' => 'közép',
                    'eredmeny' => '98%',
                ],
            ],
        ];

        $calculator = new BasePointCalculator();
        $result = $calculator->calculate($exampleData);
        $this->assertEquals(376, $result);
    }


    /**
     * Test the base point calculation.
     */
    public function test_incorrect_base_point_calculator(): void
    {
        $exampleData = [
            'valasztott-szak' => [
                'egyetem' => 'ELTE',
                'kar' => 'IK',
                'szak' => 'Programtervező informatikus',
            ],
            'erettsegi-eredmenyek' => [
                [
                    'nev' => 'matematika',
                    'tipus' => 'emelt',
                    'eredmeny' => '90%',
                ],
                [
                    'nev' => 'angol nyelv',
                    'tipus' => 'közép',
                    'eredmeny' => '94%',
                ],
                [
                    'nev' => 'informatika',
                    'tipus' => 'közép',
                    'eredmeny' => '95%',
                ],
            ],
        ];

        $calculator = new BasePointCalculator();
        $this->expectException(\Exception::class);
        $calculator->calculate($exampleData);
    }

    /**
     * Test the base point calculation.
     */
    public function test_not_enough_point_base_point_calculator(): void
    {
        $exampleData = [
            'valasztott-szak' => [
                'egyetem' => 'ELTE',
                'kar' => 'IK',
                'szak' => 'Programtervező informatikus',
            ],
            'erettsegi-eredmenyek' => [
                [
                    'nev' => 'magyar nyelv és irodalom',
                    'tipus' => 'közép',
                    'eredmeny' => '15%',
                ],
                [
                    'nev' => 'történelem',
                    'tipus' => 'közép',
                    'eredmeny' => '80%',
                ],
                [
                    'nev' => 'matematika',
                    'tipus' => 'emelt',
                    'eredmeny' => '90%',
                ],
                [
                    'nev' => 'angol nyelv',
                    'tipus' => 'közép',
                    'eredmeny' => '94%',
                ],
                [
                    'nev' => 'informatika',
                    'tipus' => 'közép',
                    'eredmeny' => '95%',
                ],
            ],
        ];

        $calculator = new BasePointCalculator();
        $this->expectException(\Exception::class);
        $calculator->calculate($exampleData);
    }
}
