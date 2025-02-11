<?php

declare(strict_types=1);

namespace App\ValueObject;

use App\Collection\MajorSubject\MajorSubjectEntityCollection;
use App\Collection\Subject\SubjectEntityCollection;
use App\Entities\Institution\InstitutionEntity;
use App\Entities\Major\MajorEntity;
use App\Entities\University\UniversityEntity;

final readonly class RequirementsVO
{
    public function __construct(
        private UniversityEntity             $university,
        private InstitutionEntity            $institution,
        private MajorEntity                  $major,
        private MajorSubjectEntityCollection $requiredSubjects,
        private MajorSubjectEntityCollection $optionalSubjects,
        private SubjectEntityCollection      $requiredBaseSubjects,
    )
    {
    }

    public function getUniversity(): UniversityEntity
    {
        return $this->university;
    }

    public function getInstitution(): InstitutionEntity
    {
        return $this->institution;
    }

    public function getMajor(): MajorEntity
    {
        return $this->major;
    }

    public function getRequiredSubjects(): MajorSubjectEntityCollection
    {
        return $this->requiredSubjects;
    }

    public function getOptionalSubjects(): MajorSubjectEntityCollection
    {
        return $this->optionalSubjects;
    }

    public function getRequiredBaseSubjects(): SubjectEntityCollection
    {
        return $this->requiredBaseSubjects;
    }
}
