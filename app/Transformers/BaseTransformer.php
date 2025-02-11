<?php

namespace App\Transformers;

use App\Entities\BaseEntity;
use Illuminate\Database\Eloquent\Model;

abstract readonly class BaseTransformer
{
    /**
     * @param Model $model
     * @return BaseEntity
     */
    public abstract function toEntity(Model $model): BaseEntity;

    /**
     * @param BaseEntity $entity
     * @return Model
     */
    public abstract function toModel(BaseEntity $entity): Model;

}
