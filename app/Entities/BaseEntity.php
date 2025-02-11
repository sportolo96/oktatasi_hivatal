<?php

namespace App\Entities;

abstract readonly class BaseEntity
{
    public function __construct(
        private ?int $id,
    )
    {
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public abstract static function builder(): BaseEntityBuilder;
}
