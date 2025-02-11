<?php

namespace App\Entities\Subject;

use App\Entities\BaseEntity;
use App\Enumerations\SubjectType;

final readonly class SubjectEntity extends BaseEntity
{
    public function __construct(
        ?int                $id,
        private string      $name,
        private SubjectType $type,
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
     * @return SubjectType
     */
    public function getType(): SubjectType
    {
        return $this->type;
    }

    public static function builder(): SubjectEntityBuilder
    {
        return new SubjectEntityBuilder();
    }
}
