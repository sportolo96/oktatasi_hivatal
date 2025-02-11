<?php

declare(strict_types=1);

namespace App\ValueObject\Input;

use App\Collection\Language\LanguageExamVOCollection;
use App\Enumerations\ExtraPointType;

final readonly class ExtraPointVO
{
    public function __construct(
        private LanguageExamVOCollection $languageExam,
    )
    {
    }

    public static function create(array $data): self
    {
        $languageExamCollection = new LanguageExamVOCollection();
        foreach ($data as $item) {
            if ($item['kategoria'] === ExtraPointType::LANGUAGE_EXAM->value) {
                $languageExamCollection->add(LanguageExamVO::create($item));
            }
        }

        return new self(
            $languageExamCollection
        );
    }

    public function getLanguageExam(): LanguageExamVOCollection
    {
        return $this->languageExam;
    }
}
