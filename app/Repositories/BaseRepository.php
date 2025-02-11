<?php

namespace App\Repositories;

use App\Entities\BaseEntity;

abstract readonly class BaseRepository
{
    /**
     * @param int $id
     * @return BaseEntity
     */
    public abstract function getById(int $id): BaseEntity;

    /**
     * @param BaseEntity $entity
     * @return BaseEntity
     */
    public abstract function save(BaseEntity $entity): BaseEntity;
}
