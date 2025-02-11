<?php

namespace App\Services;

use App\Enumerations\MajorSubjectType;
use App\Enumerations\SubjectType;
use App\Repositories\InstitutionRepository;
use App\Repositories\MajorRepository;
use App\Repositories\MajorSubjectRepository;
use App\Repositories\SubjectRepository;
use App\Repositories\UniversityRepository;
use App\ValueObject\RequirementsVO;

final readonly class DataProviderService
{
    private UniversityRepository $universityRepository;
    private InstitutionRepository $institutionRepository;
    private MajorRepository $majorRepository;
    private MajorSubjectRepository $majorSubjectRepository;
    private SubjectRepository $subjectRepository;

    public function __construct()
    {
        $this->universityRepository = new UniversityRepository();
        $this->institutionRepository = new InstitutionRepository();
        $this->majorRepository = new MajorRepository();
        $this->majorSubjectRepository = new MajorSubjectRepository();
        $this->subjectRepository = new SubjectRepository();
    }

    public function getRequirement(string $university, string $institution, string $major): RequirementsVO
    {
        $universityEntity = $this->universityRepository->getByName($university);
        $institutionEntity = $this->institutionRepository->getByNameAndUniversityId($institution, $universityEntity->getId());
        $majorEntity = $this->majorRepository->getByNameAndInstitutionId($major, $institutionEntity->getId());
        $requiredSubjectCollection = $this->majorSubjectRepository->getAllByMajorIdAndSubjectType($majorEntity->getId(), MajorSubjectType::REQUIRED);
        $optionalSubjectCollection = $this->majorSubjectRepository->getAllByMajorIdAndSubjectType($majorEntity->getId(), MajorSubjectType::OPTIONAL_REQUIRED);
        $optionalBaseSubjectCollection = $this->subjectRepository->getAllByType(SubjectType::REQUIRED);

        return new RequirementsVO(
            $universityEntity,
            $institutionEntity,
            $majorEntity,
            $requiredSubjectCollection,
            $optionalSubjectCollection,
            $optionalBaseSubjectCollection
        );
    }
}
