<?php

declare(strict_types=1);

namespace App\Collection\MajorSubject;

use App\Collection\BaseCollection;
use App\Entities\MajorSubject\MajorSubjectEntity;

/**
 * @method MajorSubjectEntity[] getIterator()
 */
final class MajorSubjectEntityCollection extends BaseCollection
{
    public function __construct(MajorSubjectEntity ...$values)
    {
        $this->values = $values;
    }
}
