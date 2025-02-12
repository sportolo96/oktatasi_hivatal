<?php

namespace App\Services;

use App\Enumerations\MajorSubjectType;
use App\Enumerations\SubjectType;
use App\Exceptions\InvalidDataException;
use App\Repositories\InstitutionRepository;
use App\Repositories\MajorRepository;
use App\Repositories\MajorSubjectRepository;
use App\Repositories\SubjectRepository;
use App\Repositories\UniversityRepository;
use App\ValueObject\RequirementsVO;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

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

    /**
     * @throws InvalidDataException
     */
    public function getRequirement(string $university, string $institution, string $major): RequirementsVO
    {
        try {
            $universityEntity = $this->universityRepository->getByName($university);
            $institutionEntity = $this->institutionRepository->getByNameAndUniversityId($institution, $universityEntity->getId());
            $majorEntity = $this->majorRepository->getByNameAndInstitutionId($major, $institutionEntity->getId());
            $requiredSubjectCollection = $this->majorSubjectRepository->getAllByMajorIdAndSubjectType($majorEntity->getId(), MajorSubjectType::REQUIRED);
            $optionalSubjectCollection = $this->majorSubjectRepository->getAllByMajorIdAndSubjectType($majorEntity->getId(), MajorSubjectType::OPTIONAL_REQUIRED);
            $optionalBaseSubjectCollection = $this->subjectRepository->getAllByType(SubjectType::REQUIRED);

        } catch (ModelNotFoundException $exception) {
            Log::error($exception->getMessage());
            throw new InvalidDataException(__('exception.invalid_inputs'));
        }

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
