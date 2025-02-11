<?php

namespace App\Entities\Major;

use App\Entities\BaseEntity;

final readonly class MajorEntity extends BaseEntity
{
    public function __construct(
        ?int           $id,
        private string $name,
        private int    $institutionId,
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

    /**
     * @return int
     */
    public function getInstitutionId(): int
    {
        return $this->institutionId;
    }

    public static function builder(): MajorEntityBuilder
    {
        return new MajorEntityBuilder();
    }
}
