<?php

namespace App\Transformers;

use App\Entities\BaseEntity;
use App\Entities\University\UniversityEntity;
use App\Models\University;
use Illuminate\Database\Eloquent\Model;

final readonly class UniversityTransformer extends BaseTransformer
{
    /**
     * @param University|Model $model
     * @return UniversityEntity
     */
    public function toEntity(University|Model $model): UniversityEntity {
        return UniversityEntity::builder()
            ->setId($model->id)
            ->setName($model->name)
            ->build();
    }

    /**
     * @param UniversityEntity|BaseEntity $entity
     * @return University
     */
    public function toModel(UniversityEntity|BaseEntity $entity): University
    {
        $model = new University();

        $model->id = $entity->getId();
        $model->name = $entity->getName();

        return $model;
    }
}
