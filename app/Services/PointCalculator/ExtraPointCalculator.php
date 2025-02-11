<?php

namespace App\Services\PointCalculator;

final readonly class ExtraPointCalculator extends AbstractPointCalculator
{
    public function calculate(array $data): int
    {
        $results = json_encode($data['valasztott-szak']);
        $results = json_decode($results);

        $szak = collect($results, true);

        $results = json_encode($data['erettsegi-eredmenyek']);
        $results = json_decode($results);

        $eredmenyek = collect($results, true);

        $results = json_encode($data['tobbletpontok']);
        $results = json_decode($results);

        $tobbletpontok = collect($results, true);

        $pontok = 0;

        foreach ($eredmenyek as $eredmeny) {
            if( $eredmeny->tipus === 'emelt') {
                $pontok += 50;

                break;
            }
        }

        $addedCategories = collect([]);

        foreach ($tobbletpontok as $tobbletpont) {
            if ($addedCategories->where('kategoria', $tobbletpont->kategoria)->where('tipus', $tobbletpont->tipus)->where('nyelv', $tobbletpont->nyelv)->count()) {
                continue;
            }

            if($tobbletpont->kategoria === 'Nyelvvizsga') {
                $addedCategories->push($tobbletpont);
                switch($tobbletpont->tipus) {
                    case 'B2':
                        $pontok += 28;
                        break;
                    case 'C1':
                        if ($addedCategories->where('kategoria', $tobbletpont->kategoria)->where('tipus', 'B2')->where('nyelv', $tobbletpont->nyelv)->count()) {
                            $pontok -= 28;
                        }
                        $pontok += 40;
                        break;
                };
            }
        }



        return ($pontok <= 100) ? $pontok : 100;
    }
}
