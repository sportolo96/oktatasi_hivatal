<?php

declare(strict_types=1);

namespace App\Collection\Subject;

use App\Collection\BaseCollection;
use App\Entities\Subject\SubjectEntity;

/**
 * @method SubjectEntity[] getIterator()
 */
final class SubjectEntityCollection extends BaseCollection
{
    public function __construct(SubjectEntity ...$values)
    {
        $this->values = $values;
    }
}
