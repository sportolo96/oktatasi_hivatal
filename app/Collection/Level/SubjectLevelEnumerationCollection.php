<?php

declare(strict_types=1);

namespace App\Collection\Level;

use App\Collection\BaseCollection;
use App\Enumerations\SubjectLevel;

/**
 * @method SubjectLevel[] getIterator()
 */
final class SubjectLevelEnumerationCollection extends BaseCollection
{
    public function __construct(SubjectLevel ...$values)
    {
        $this->values = $values;
    }

    public function toValueArray(): array
    {
        $array = [];
        foreach ($this->values as $value) {
            $array[] = $value->value;
        }

        return $array;
    }
}
