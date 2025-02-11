<?php

namespace App\Repositories;

use App\Collection\MajorSubject\MajorSubjectEntityCollection;
use App\Entities\BaseEntity;
use App\Entities\MajorSubject\MajorSubjectEntity;
use App\Enumerations\MajorSubjectType;
use App\Models\MajorSubject;
use App\Transformers\MajorSubjectTransformer;

final readonly class MajorSubjectRepository extends BaseRepository
{
    private MajorSubjectTransformer $majorSubjectTransformer;

    public function __construct()
    {
        $this->majorSubjectTransformer = new MajorSubjectTransformer();
    }

    public function getById(int $id): MajorSubjectEntity
    {
        return $this->majorSubjectTransformer->toEntity(MajorSubject::find($id));
    }

    public function getAllByMajorIdAndSubjectId(int $majorId, int $subjectId): MajorSubjectEntityCollection
    {
        $query = MajorSubject::where('major_id', $majorId)->where('subject_id', $subjectId)->get();

        return new MajorSubjectEntityCollection(...array_map(function (MajorSubject $model): MajorSubjectEntity {
            return $this->majorSubjectTransformer->toEntity($model);
        }, $query->all()));
    }

    public function getAllByMajorIdAndSubjectType(int $majorId, MajorSubjectType $type): MajorSubjectEntityCollection
    {
        $query = MajorSubject::where('major_id', $majorId)->where('type', $type->value)->get();

        return new MajorSubjectEntityCollection(...array_map(function (MajorSubject $model): MajorSubjectEntity {
            return $this->majorSubjectTransformer->toEntity($model);
        }, $query->all()));
    }

    public function save(MajorSubjectEntity|BaseEntity $entity): MajorSubjectEntity
    {
        $model = $this->majorSubjectTransformer->toModel($entity);

        $model->save();

        return $this->majorSubjectTransformer->toEntity($model);
    }
}
