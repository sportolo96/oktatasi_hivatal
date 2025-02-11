<?php

namespace App\Transformers;

use App\Entities\BaseEntity;
use App\Entities\Institution\InstitutionEntity;
use App\Models\Institution;
use Illuminate\Database\Eloquent\Model;

final readonly class InstitutionTransformer extends BaseTransformer
{
    /**
     * @param Institution|Model $model
     * @return InstitutionEntity
     */
    public function toEntity(Institution|Model $model): InstitutionEntity
    {
        return InstitutionEntity::builder()
            ->setId($model->id)
            ->setName($model->name)
            ->setUniversityId($model->university_id)
            ->build();
    }

    /**
     * @param InstitutionEntity|BaseEntity $entity
     * @return Institution
     */
    public function toModel(InstitutionEntity|BaseEntity $entity): Institution
    {
        $model = new Institution();

        $model->id = $entity->getId();
        $model->name = $entity->getName();
        $model->university_id = $entity->getUniversityId();

        return $model;
    }
}
