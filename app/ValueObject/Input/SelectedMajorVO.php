<?php

declare(strict_types=1);

namespace App\ValueObject\Input;

final readonly class SelectedMajorVO
{
    public function __construct(
        private string $universityName,
        private string $institutionName,
        private string $majorName,
    )
    {
    }

    public static function create(array $data): self
    {
        $universityName = trim($data['egyetem']);
        $institutionName = trim($data['kar']);
        $majorName = trim($data['szak']);

        return new self(
            $universityName,
            $institutionName,
            $majorName,
        );
    }

    public function getUniversityName(): ?string
    {
        return $this->universityName;
    }

    public function getInstitutionName(): string
    {
        return $this->institutionName;
    }

    public function getMajorName(): string
    {
        return $this->majorName;
    }
}
