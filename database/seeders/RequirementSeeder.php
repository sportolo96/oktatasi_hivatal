<?php

namespace Database\Seeders;

use App\Entities\Institution\InstitutionEntity;
use App\Entities\Major\MajorEntity;
use App\Entities\MajorSubject\MajorSubjectEntity;
use App\Entities\University\UniversityEntity;
use App\Enumerations\MajorSubjectType;
use App\Enumerations\SubjectLevel;
use App\Repositories\InstitutionRepository;
use App\Repositories\MajorRepository;
use App\Repositories\MajorSubjectRepository;
use App\Repositories\SubjectRepository;
use App\Repositories\UniversityRepository;
use Illuminate\Database\Seeder;

class RequirementSeeder extends Seeder
{
    private SubjectRepository $subjectRepository;
    private UniversityRepository $universityRepository;
    private InstitutionRepository $institutionRepository;
    private MajorRepository $majorRepository;
    private MajorSubjectRepository $majorSubjectRepository;

    public function __construct()
    {
        $this->subjectRepository = new SubjectRepository();
        $this->universityRepository = new UniversityRepository();
        $this->institutionRepository = new InstitutionRepository();
        $this->majorRepository = new MajorRepository();
        $this->majorSubjectRepository = new MajorSubjectRepository();
    }

    public function run()
    {
        $data = config('requirement');

        foreach ($data as $universityName => $institutions) {
            $universityId = $this->createUniversity($universityName);

            foreach ($institutions as $institutionName => $majors) {
                $institutionId = $this->createInstitution($institutionName, $universityId);

                foreach ($majors as $majorName => $subjects) {
                    $majorId = $this->createMajor($majorName, $institutionId);

                    $this->createSubjectRelations($majorId, $subjects[MajorSubjectType::REQUIRED->value], MajorSubjectType::REQUIRED);
                    $this->createSubjectRelations($majorId, $subjects[MajorSubjectType::OPTIONAL_REQUIRED->value], MajorSubjectType::OPTIONAL_REQUIRED);
                }
            }
        }
    }

    private function createUniversity(string $name): int
    {
        $entity = UniversityEntity::builder()
            ->setName($name)
            ->build();

        return $this->universityRepository->save($entity)?->getId();
    }

    private function createInstitution(string $name, int $universityId): int
    {
        $entity = InstitutionEntity::builder()
            ->setName($name)
            ->setUniversityId($universityId)
            ->build();

        return $this->institutionRepository->save($entity)?->getId();
    }

    private function createMajor(string $name, int $institutionId): int
    {
        $entity = MajorEntity::builder()
            ->setName($name)
            ->setInstitutionId($institutionId)
            ->build();

        return $this->majorRepository->save($entity)?->getId();
    }

    private function createSubjectRelations(int $majorId, array $subjects, MajorSubjectType $type): void
    {
        foreach ($subjects as $subjectName => $level) {
            $subjectEntity = $this->subjectRepository->getByName((string)$subjectName);

            $this->createMajorSubject($majorId, $subjectEntity->getId(), $level, $type);
        }
    }

    private function createMajorSubject(int $majorId, int $subjectId, SubjectLevel $level, MajorSubjectType $type): void
    {
        $entity = MajorSubjectEntity::builder()
            ->setMajorId($majorId)
            ->setSubjectId($subjectId)
            ->setLevel($level)
            ->setType($type)
            ->build();

        $this->majorSubjectRepository->save($entity);
    }
}
