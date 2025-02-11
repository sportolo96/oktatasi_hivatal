<?php

namespace Database\Seeders;

use App\Entities\Subject\SubjectEntity;
use App\Repositories\SubjectRepository;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    private SubjectRepository $subjectRepository;

    public function __construct()
    {
        $this->subjectRepository = new SubjectRepository();
    }

    public function run()
    {
        $data = config('subject');

        foreach ($data as $subject => $type) {
            $entity = SubjectEntity::builder()
                ->setName((string)$subject)
                ->setType($type)
                ->build();

            $this->subjectRepository->save($entity);
        }
    }
}
