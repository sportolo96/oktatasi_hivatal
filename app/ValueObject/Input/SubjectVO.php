<?php

declare(strict_types=1);

namespace App\ValueObject\Input;

use App\Enumerations\SubjectLevel;

final readonly class SubjectVO
{
    public function __construct(
        private string       $name,
        private SubjectLevel $level,
        private int          $percent,
    )
    {
    }

    public static function create(array $data): self
    {
        $name = trim($data['nev']);
        $level = SubjectLevel::tryFrom(trim($data['tipus']));
        $percent = (int)trim($data['eredmeny']);

        return new self(
            $name,
            $level,
            $percent,
        );
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLevel(): SubjectLevel
    {
        return $this->level;
    }

    public function getPercent(): int
    {
        return $this->percent;
    }
}
