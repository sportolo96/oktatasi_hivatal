<?php

namespace App\Transformers;

use App\Entities\BaseEntity;
use App\Entities\Major\MajorEntity;
use App\Models\Major;
use Illuminate\Database\Eloquent\Model;

final readonly class MajorTransformer extends BaseTransformer
{
    /**
     * @param Major|Model $model
     * @return MajorEntity
     */
    public function toEntity(Major|Model $model): MajorEntity
    {
        return MajorEntity::builder()
            ->setId($model->id)
            ->setName($model->name)
            ->setInstitutionId($model->institution_id)
            ->build();
    }

    /**
     * @param MajorEntity|BaseEntity $entity
     * @return Major
     */
    public function toModel(MajorEntity|BaseEntity $entity): Major
    {
        $model = new Major();

        $model->id = $entity->getId();
        $model->name = $entity->getName();
        $model->institution_id = $entity->getInstitutionId();

        return $model;
    }
}
