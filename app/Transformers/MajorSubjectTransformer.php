<?php

namespace App\Transformers;

use App\Entities\BaseEntity;
use App\Entities\MajorSubject\MajorSubjectEntity;
use App\Models\MajorSubject;
use Illuminate\Database\Eloquent\Model;

final readonly class MajorSubjectTransformer extends BaseTransformer
{
    /**
     * @param MajorSubject|Model $model
     * @return MajorSubjectEntity
     */
    public function toEntity(MajorSubject|Model $model): MajorSubjectEntity
    {
        return MajorSubjectEntity::builder()
            ->setId($model->id)
            ->setSubjectId($model->subject_id)
            ->setMajorId($model->major_id)
            ->setLevel($model->level)
            ->setType($model->type)
            ->build();
    }

    /**
     * @param MajorSubjectEntity|BaseEntity $entity
     * @return MajorSubject
     */
    public function toModel(MajorSubjectEntity|BaseEntity $entity): MajorSubject
    {
        $model = new MajorSubject();

        $model->id = $entity->getId();
        $model->major_id = $entity->getMajorId();
        $model->subject_id = $entity->getSubjectId();
        $model->level = $entity->getLevel()->value;
        $model->type = $entity->getType()->value;

        return $model;
    }
}
