<?php

namespace App\Entities\University;

use App\Entities\BaseEntity;

final readonly class UniversityEntity extends BaseEntity
{
    public function __construct(
        ?int           $id,
        private string $name,
    )
    {
        parent::__construct($id);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public static function builder(): UniversityEntityBuilder
    {
        return new UniversityEntityBuilder();
    }
}
