<?php

namespace App\Entities\MajorSubject;

use App\Entities\BaseEntityBuilder;
use App\Enumerations\MajorSubjectType;
use App\Enumerations\SubjectLevel;

final class MajorSubjectEntityBuilder extends BaseEntityBuilder
{
    private int $majorId;
    private int $subjectId;
    private SubjectLevel $level;
    private MajorSubjectType $type;

    /**
     * @param int $majorId
     * @return MajorSubjectEntityBuilder
     */
    public function setMajorId(int $majorId): self
    {
        $this->majorId = $majorId;

        return $this;
    }

    /**
     * @param int $subjectId
     * @return MajorSubjectEntityBuilder
     */
    public function setSubjectId(int $subjectId): self
    {
        $this->subjectId = $subjectId;

        return $this;
    }

    /**
     * @param SubjectLevel $level
     * @return MajorSubjectEntityBuilder
     */
    public function setLevel(SubjectLevel $level): self
    {
        $this->level = $level;

        return $this;
    }

    /**
     * @param MajorSubjectType $type
     * @return MajorSubjectEntityBuilder
     */
    public function setType(MajorSubjectType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function build(): MajorSubjectEntity
    {
        return new MajorSubjectEntity(
            $this->id,
            $this->majorId,
            $this->subjectId,
            $this->level,
            $this->type,
        );
    }
}
