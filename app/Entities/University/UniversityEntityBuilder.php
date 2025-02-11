<?php

namespace App\Entities\University;

use App\Entities\BaseEntityBuilder;

final class UniversityEntityBuilder extends BaseEntityBuilder
{
    protected string $name;

    /**
     * @param string $name
     * @return UniversityEntityBuilder
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function build(): UniversityEntity
    {
        return new UniversityEntity(
            $this->id,
            $this->name,
        );
    }
}
