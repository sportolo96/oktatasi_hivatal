<?php

namespace App\Repositories;

use App\Entities\BaseEntity;
use App\Entities\Major\MajorEntity;
use App\Models\Major;
use App\Transformers\MajorTransformer;

final readonly class MajorRepository extends BaseRepository
{
    private MajorTransformer $majorTransformer;

    public function __construct()
    {
        $this->majorTransformer = new MajorTransformer();
    }

    public function getById(int $id): MajorEntity
    {
        return $this->majorTransformer->toEntity(Major::find($id));
    }

    public function getByName(string $name): MajorEntity
    {
        return $this->majorTransformer->toEntity(Major::where('name', $name)->first());
    }

    public function getByNameAndInstitutionId(string $name, int $institutionId): MajorEntity
    {
        return $this->majorTransformer->toEntity(Major::where('name', $name)->where('institution_id', $institutionId)->first());
    }

    public function save(MajorEntity|BaseEntity $entity): MajorEntity
    {
        $model = $this->majorTransformer->toModel($entity);

        $model->save();

        return $this->majorTransformer->toEntity($model);
    }
}
