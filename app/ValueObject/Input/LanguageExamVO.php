<?php

declare(strict_types=1);

namespace App\ValueObject\Input;

use App\Enumerations\LanguageExamLevel;

final readonly class LanguageExamVO
{
    public function __construct(
        private string            $language,
        private LanguageExamLevel $level,
    )
    {
    }

    public static function create(array $data): self
    {
        $language = trim($data['nyelv']);
        $level = LanguageExamLevel::tryFrom(trim($data['tipus']));

        return new self(
            $language,
            $level,
        );
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function getLevel(): LanguageExamLevel
    {
        return $this->level;
    }
}
