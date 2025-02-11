<?php

namespace App\Repositories;

use App\Collection\Subject\SubjectEntityCollection;
use App\Entities\BaseEntity;
use App\Entities\Subject\SubjectEntity;
use App\Enumerations\SubjectType;
use App\Models\Subject;
use App\Transformers\SubjectTransformer;

final readonly class SubjectRepository extends BaseRepository
{
    private SubjectTransformer $subjectTransformer;

    public function __construct()
    {
        $this->subjectTransformer = new SubjectTransformer();
    }

    public function getById(int $id): SubjectEntity
    {
        return $this->subjectTransformer->toEntity(Subject::find($id));
    }

    public function getByName(string $name): SubjectEntity
    {
        return $this->subjectTransformer->toEntity(Subject::where('name', $name)->first());
    }

    public function getAllByType(SubjectType $type): SubjectEntityCollection
    {
        $query = Subject::where('type', $type->value)->get();

        return new SubjectEntityCollection(...array_map(function (Subject $model): SubjectEntity {
            return $this->subjectTransformer->toEntity($model);
        }, $query->all()));
    }

    public function save(SubjectEntity|BaseEntity $entity): SubjectEntity
    {
        $model = $this->subjectTransformer->toModel($entity);

        $model->save();

        return $this->subjectTransformer->toEntity($model);
    }
}
