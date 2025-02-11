<?php

namespace App\Entities\MajorSubject;

use App\Entities\BaseEntity;
use App\Enumerations\MajorSubjectType;
use App\Enumerations\SubjectLevel;

final readonly class MajorSubjectEntity extends BaseEntity
{
    public function __construct(
        ?int                     $id,
        private int              $majorId,
        private int              $subjectId,
        private SubjectLevel     $level,
        private MajorSubjectType $type,
    )
    {
        parent::__construct($id);
    }

    /**
     * @return int
     */
    public function getMajorId(): int
    {
        return $this->majorId;
    }

    /**
     * @return int
     */
    public function getSubjectId(): int
    {
        return $this->subjectId;
    }

    /**
     * @return SubjectLevel
     */
    public function getLevel(): SubjectLevel
    {
        return $this->level;
    }

    /**
     * @return MajorSubjectType
     */
    public function getType(): MajorSubjectType
    {
        return $this->type;
    }

    public static function builder(): MajorSubjectEntityBuilder
    {
        return new MajorSubjectEntityBuilder();
    }
}
