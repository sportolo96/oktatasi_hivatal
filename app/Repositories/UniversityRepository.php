<?php

namespace App\Repositories;

use App\Entities\BaseEntity;
use App\Entities\University\UniversityEntity;
use App\Models\University;
use App\Transformers\UniversityTransformer;

final readonly class UniversityRepository extends BaseRepository
{
    private UniversityTransformer $universityTransformer;

    public function __construct()
    {
        $this->universityTransformer = new UniversityTransformer();
    }

    public function getById(int $id): UniversityEntity
    {
        return $this->universityTransformer->toEntity(University::findOrFail($id));
    }

    public function getByName(string $name): UniversityEntity
    {
        return $this->universityTransformer->toEntity(University::where('name', $name)->firstOrFail());
    }

    public function save(UniversityEntity|BaseEntity $entity): UniversityEntity
    {
        $model = $this->universityTransformer->toModel($entity);

        $model->save();

        return $this->universityTransformer->toEntity($model);
    }
}
