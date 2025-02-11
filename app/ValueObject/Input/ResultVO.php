<?php

declare(strict_types=1);

namespace App\ValueObject\Input;

use App\Collection\Subject\SubjectVOCollection;

final readonly class ResultVO
{
    public function __construct(
        private SubjectVOCollection $result,
    )
    {
    }

    public static function create(array $data): self
    {
        $collection = new SubjectVOCollection();
        foreach ($data as $item) {
            $collection->add(SubjectVO::create($item));
        }

        return new self(
            $collection
        );
    }

    public function getResult(): SubjectVOCollection
    {
        return $this->result;
    }
}
