<?php

namespace App\Entities;

abstract class BaseEntityBuilder
{
    protected ?int $id = null;

    /**
     * @param int|null $id
     * @return BaseEntityBuilder
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public abstract function build(): BaseEntity;
}
