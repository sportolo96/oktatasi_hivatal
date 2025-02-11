<?php

namespace App\Entities\Institution;

use App\Entities\BaseEntity;

final readonly class InstitutionEntity extends BaseEntity
{
    public function __construct(
        ?int           $id,
        private string $name,
        private int    $universityId,
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
    public function getUniversityId(): int
    {
        return $this->universityId;
    }

    public static function builder(): InstitutionEntityBuilder
    {
        return new InstitutionEntityBuilder();
    }
}
