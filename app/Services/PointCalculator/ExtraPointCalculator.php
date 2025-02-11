<?php

namespace App\Services\PointCalculator;

use App\Collection\Language\LanguageExamVOCollection;
use App\Enumerations\LanguageExamLevel;
use App\Enumerations\SubjectLevel;
use App\ValueObject\Input\InputVO;

final readonly class ExtraPointCalculator implements PointCalculatorInterface
{
    const ADVANCED_LEVEL_POINT = 50;
    const LANGUAGE_B2_POINT = 28;
    const LANGUAGE_C1_POINT = 40;

    public function calculate(InputVO $input): int
    {
        $results = $input->getResult()?->getResult();

        $extras = $input->getExtraPoint();

        $point = 0;

        foreach ($results as $result) {
            if ($result->getLevel() === SubjectLevel::ADVANCED) {
                $point += self::ADVANCED_LEVEL_POINT;

                break;
            }
        }

        $checkedLanguageExams = new LanguageExamVOCollection();

        foreach ($extras?->getLanguageExam() as $languageExam) {
            if ($checkedLanguageExams->findByLanguageAndLevels($languageExam->getLanguage(), $languageExam->getLevel())) {
                continue;
            }

            $checkedLanguageExams->add($languageExam);
            switch ($languageExam->getLevel()) {

                case LanguageExamLevel::B2:
                    $point += self::LANGUAGE_B2_POINT;
                    break;

                case LanguageExamLevel::C1:
                    if ($checkedLanguageExams->findByLanguageAndLevels($languageExam->getLanguage(), LanguageExamLevel::B2)) {
                        $point -= self::LANGUAGE_B2_POINT;
                    }

                    $point += self::LANGUAGE_C1_POINT;
                    break;
            };

        }


        return ($point <= 100) ? $point : 100;
    }
}
