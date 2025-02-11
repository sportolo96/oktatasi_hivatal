<?php

namespace App\Entities\Institution;

use App\Entities\BaseEntityBuilder;

final class InstitutionEntityBuilder extends BaseEntityBuilder
{
    protected string $name;
    protected int $universityId;

    /**
     * @param string $name
     * @return InstitutionEntityBuilder
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param int $universityId
     * @return InstitutionEntityBuilder
     */
    public function setUniversityId(int $universityId): self
    {
        $this->universityId = $universityId;

        return $this;
    }

    public function build(): InstitutionEntity
    {
        return new InstitutionEntity(
            $this->id,
            $this->name,
            $this->universityId,
        );
    }
}
