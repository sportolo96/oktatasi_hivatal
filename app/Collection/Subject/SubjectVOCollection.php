<?php

declare(strict_types=1);

namespace App\Collection\Subject;

use App\Collection\BaseCollection;
use App\Collection\Level\SubjectLevelEnumerationCollection;
use App\ValueObject\Input\SubjectVO;

/**
 * @method SubjectVO[] getIterator()
 */
final class SubjectVOCollection extends BaseCollection
{
    public function __construct(SubjectVO ...$values)
    {
        $this->values = $values;
    }

    public function findByName(string $name): ?SubjectVO
    {
        foreach ($this->values as $value) {
            if ($value->getName() === $name) {
                return $value;
            }
        }

        return null;
    }

    public function findByNameAndLevels(string $name, SubjectLevelEnumerationCollection $levels): ?SubjectVO
    {
        foreach ($this->values as $value) {
            if ($value->getName() === $name && in_array($value->getLevel()->value, $levels->toValueArray())) {
                return $value;
            }
        }

        return null;
    }
}
