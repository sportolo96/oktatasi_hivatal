<?php

namespace App\Services\PointCalculator;

use App\Collection\Level\SubjectLevelEnumerationCollection;
use App\Collection\Subject\SubjectVOCollection;
use App\Enumerations\SubjectLevel;
use App\Exceptions\AbstractCalculatorException;
use App\Exceptions\NotEnoughPerCentCalculatorException;
use App\Exceptions\RequiredSubjectCalculatorException;
use App\Repositories\SubjectRepository;
use App\Services\DataProviderService;
use App\ValueObject\Input\InputVO;
use App\ValueObject\RequirementsVO;
use Exception;

final readonly class BasePointCalculator implements PointCalculatorInterface
{
    protected DataProviderService $dataProviderService;
    protected SubjectRepository $subjectRepository;

    public function __construct()
    {
        $this->dataProviderService = new DataProviderService();
        $this->subjectRepository = new SubjectRepository();
    }

    /**
     * @throws AbstractCalculatorException|\Exception
     */
    public function calculate(InputVO $input): int
    {
        $selectedMajor = $input->getSelectedMajor();
        $results = $input->getResult()?->getResult();

        $requirements = $this->dataProviderService->getRequirement($selectedMajor->getUniversityName(), $selectedMajor->getInstitutionName(), $selectedMajor->getMajorName());

        foreach ($results as $subject) {
            if ($subject->getPercent() < 20) {
                throw new NotEnoughPerCentCalculatorException(__('not_enough_per_cent_in_subject'));
            }
        }

        foreach ($requirements->getRequiredBaseSubjects() as $requiredBaseSubject) {
            if (!$results->findByName($requiredBaseSubject->getName())) {
                throw new RequiredSubjectCalculatorException(__('required_subject'));
            }
        }

        $basePoint = $this->calculateBasePoint($requirements, $results);
        $optionalPoint = $this->calculateOptionalPoint($requirements, $results);

        return 2 * ($basePoint + $optionalPoint);
    }

    private function calculateBasePoint(RequirementsVO $requirements, SubjectVOCollection $results): int
    {
        $points = 0;

        foreach ($requirements->getRequiredSubjects() as $requiredSubject) {

            $levels = new SubjectLevelEnumerationCollection($requiredSubject->getLevel());
            if ($requiredSubject->getLevel() === SubjectLevel::INTERMEDIATE) {
                $levels->add(SubjectLevel::ADVANCED);
            }

            $subject = $this->subjectRepository->getById($requiredSubject->getSubjectId());

            $currentSubject = $results->findByNameAndLevels($subject->getName(), $levels);
            if (!$currentSubject) {
                throw new RequiredSubjectCalculatorException(__('required_subject'));
            }

            $points += $currentSubject->getPercent();
        }

        return $points;
    }

    /**
     * @throws RequiredSubjectCalculatorException
     */
    private function calculateOptionalPoint(RequirementsVO $requirements, SubjectVOCollection $results): int
    {
        $hasOneOptional = false;
        $best = 0;

        foreach ($requirements->getOptionalSubjects() as $optionalSubject) {
            $levels = new SubjectLevelEnumerationCollection($optionalSubject->getLevel());
            if ($optionalSubject->getLevel() === SubjectLevel::INTERMEDIATE) {
                $levels->add(SubjectLevel::ADVANCED);
            }

            $subject = $this->subjectRepository->getById($optionalSubject->getSubjectId());

            $currentSubject = $results->findByNameAndLevels($subject->getName(), $levels);
            if (!$currentSubject) {
                continue;
            }

            $hasOneOptional = true;

            if ($currentSubject->getPercent() > $best) {
                $best = $currentSubject->getPercent();
            }
        }

        if (!$hasOneOptional) {
            throw new RequiredSubjectCalculatorException(__('required_optional_subject'));
        }

        return $best;
    }
}
