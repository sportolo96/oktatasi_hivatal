<?php

namespace App\Entities\Subject;

use App\Entities\BaseEntityBuilder;
use App\Enumerations\SubjectType;

final class SubjectEntityBuilder extends BaseEntityBuilder
{
    protected string $name;
    protected SubjectType $type;

    /**
     * @param string $name
     * @return SubjectEntityBuilder
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param SubjectType $type
     * @return SubjectEntityBuilder
     */
    public function setType(SubjectType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function build(): SubjectEntity
    {
        return new SubjectEntity(
            $this->id,
            $this->name,
            $this->type,
        );
    }
}
