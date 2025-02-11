<?php

namespace App\Entities\Major;

use App\Entities\BaseEntityBuilder;

final class MajorEntityBuilder extends BaseEntityBuilder
{
    protected string $name;
    protected int $institutionId;

    /**
     * @param string $name
     * @return MajorEntityBuilder
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param int $institutionId
     * @return MajorEntityBuilder
     */
    public function setInstitutionId(int $institutionId): self
    {
        $this->institutionId = $institutionId;

        return $this;
    }

    public function build(): MajorEntity
    {
        return new MajorEntity(
            $this->id,
            $this->name,
            $this->institutionId,
        );
    }
}
