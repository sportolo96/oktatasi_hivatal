<?php

namespace App\Services\PointCalculator;

use App\Exceptions\AbstractCalculatorException;
use App\ValueObject\Input\InputVO;

final readonly class PointCalculator implements PointCalculatorInterface
{
    private BasePointCalculator $basePointCalculator;
    private ExtraPointCalculator $extraPointCalculator;

    public function __construct()
    {
        $this->basePointCalculator = new BasePointCalculator();
        $this->extraPointCalculator = new ExtraPointCalculator();
    }

    /**
     * @throws AbstractCalculatorException|\Exception
     */
    public function calculate(InputVO $input): int
    {
        $basePoints = $this->basePointCalculator->calculate($input);
        $extraPoints = $this->extraPointCalculator->calculate($input);

        return $basePoints + $extraPoints;
    }
}
