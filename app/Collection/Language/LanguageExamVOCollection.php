<?php

declare(strict_types=1);

namespace App\Collection\Language;

use App\Collection\BaseCollection;
use App\Enumerations\LanguageExamLevel;
use App\ValueObject\Input\LanguageExamVO;

/**
 * @method LanguageExamVO[] getIterator()
 */
final class LanguageExamVOCollection extends BaseCollection
{
    public function __construct(LanguageExamVO ...$values)
    {
        $this->values = $values;
    }

    public function findByLanguageAndLevels(string $language, LanguageExamLevel $level): ?LanguageExamVO
    {
        foreach ($this->values as $value) {
            if ($value->getLanguage() === $language && $value->getLevel() === $level) {
                return $value;
            }
        }

        return null;
    }
}
