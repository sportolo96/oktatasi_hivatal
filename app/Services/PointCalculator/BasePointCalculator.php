<?php

namespace App\Services\PointCalculator;

use Exception;

final readonly class BasePointCalculator extends AbstractPointCalculator
{
    const kovetelmenyek = [
        'ELTE' => [
            'IK' => [
                'Programtervező informatikus' => [
                    'kotelezo' => ['matematika' => 'közép'],
                    'kotelezoen_valaszthato' => [
                        'informatika' => 'közép', 'biológia' => 'közép', 'fizika' => 'közép', 'kémia' => 'közép'
                    ],
                ]
            ]
        ],
        'PPKE' => [
            'BTK' => [
                'Anglisztika' => [
                    'kotelezo' => ['angol' => 'emelt'],
                    'kotelezoen_valaszthato' => [
                        ['francia' => 'közép'], ['német' => 'közép'], ['olasz' => 'közép'], ['orosz' => 'közép'], ['spanyol' => 'közép'], ['történelem' => 'közép']
                    ],
                ]
            ]
        ]
    ];

    const kotelezok = [
        'magyar nyelv és irodalom',
        'történelem',
        'matematika',
    ];

    /**
     * @throws Exception
     */
    public function calculate(array $data): int
    {
        $results = json_encode($data['valasztott-szak']);
        $results = json_decode($results);

        $szak = collect($results, true);

        $targyak = self::kovetelmenyek[$szak['egyetem']][$szak['kar']][$szak['szak']];

        $results = json_encode($data['erettsegi-eredmenyek']);
        $results = json_decode($results);

        $eredmenyek = collect($results, true);

        foreach ($eredmenyek as $eredmeny) {
            if((int) $eredmeny->eredmeny < 20) {
                throw new Exception;
            }
        }

        foreach(self::kotelezok as $kotelezo) {
            if(!$eredmenyek->where('nev', $kotelezo)->count()) {
                throw new Exception;
            }
        }

        $alappont = 0;

        foreach ($targyak['kotelezo'] as $targy => $szint){

            $szintek = [];
            $szintek[] = $szint;
            if ($szint === 'közép') {
                $szintek[] = 'emelt';
            }

            if(!$eredmenyek->where('nev', $targy)->whereIn('tipus', $szintek)->count()) {
                throw new Exception;
            }

            $alappont += (int) ($eredmenyek->where('nev', $targy)->whereIn('tipus', $szintek)->first()->eredmeny);

        }

        $vanLegalabbEgyValasztott = false;
        $legjobb = 0;
        foreach ($targyak['kotelezoen_valaszthato'] as $targy => $szint){

            $szintek = [];
            $szintek[] = $szint;
            if ($szint === 'közép') {
                $szintek[] = 'emelt';
            }

            if($eredmenyek->where('nev', $targy)->whereIn('tipus', $szintek)->count()) {
                $vanLegalabbEgyValasztott = true;
            }

            $tmpEredmeny = $eredmenyek->where('nev', $targy)->whereIn('tipus', $szintek)->first();
            if ($tmpEredmeny?->eredmeny && (int) $tmpEredmeny?->eredmeny > $legjobb) {
                $legjobb = (int) $tmpEredmeny?->eredmeny;
            }
        }

        if (!$vanLegalabbEgyValasztott) {
            throw new Exception;
        }

        return 2 * ($alappont + $legjobb);
    }
}
