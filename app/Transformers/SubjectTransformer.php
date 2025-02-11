<?php

namespace App\Transformers;

use App\Entities\BaseEntity;
use App\Entities\Subject\SubjectEntity;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Model;

final readonly class SubjectTransformer extends BaseTransformer
{
    /**
     * @param Subject|Model $model
     * @return SubjectEntity
     */
    public function toEntity(Subject|Model $model): SubjectEntity
    {
        return SubjectEntity::builder()
            ->setId($model->id)
            ->setName($model->name)
            ->setType($model->type)
            ->build();
    }

    /**
     * @param SubjectEntity|BaseEntity $entity
     * @return Subject
     */
    public function toModel(SubjectEntity|BaseEntity $entity): Subject
    {
        $model = new Subject();

        $model->id = $entity->getId();
        $model->name = $entity->getName();
        $model->type = $entity->getType()->value;

        return $model;
    }
}
