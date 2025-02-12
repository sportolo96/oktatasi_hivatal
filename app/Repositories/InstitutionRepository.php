<?php

namespace App\Repositories;

use App\Entities\BaseEntity;
use App\Entities\Institution\InstitutionEntity;
use App\Entities\University\UniversityEntity;
use App\Models\Institution;
use App\Transformers\InstitutionTransformer;

final readonly class InstitutionRepository extends BaseRepository
{
    private InstitutionTransformer $institutionTransformer;

    public function __construct()
    {
        $this->institutionTransformer = new InstitutionTransformer();
    }

    public function getById(int $id): InstitutionEntity
    {
        return $this->institutionTransformer->toEntity(Institution::findOrFail($id));
    }

    public function getByName(string $name): InstitutionEntity
    {
        return $this->institutionTransformer->toEntity(Institution::where('name', $name)->firstOrFail());
    }

    public function getByNameAndUniversityId(string $name, int $universityId): InstitutionEntity
    {
        return $this->institutionTransformer->toEntity(Institution::where('name', $name)->where('university_id', $universityId)->firstOrFail());
    }

    public function save(UniversityEntity|BaseEntity $entity): InstitutionEntity
    {
        $model = $this->institutionTransformer->toModel($entity);

        $model->save();

        return $this->institutionTransformer->toEntity($model);
    }
}
