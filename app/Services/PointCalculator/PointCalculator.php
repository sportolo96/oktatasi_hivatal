<?php

namespace App\Services\PointCalculator;

final readonly class PointCalculator extends AbstractPointCalculator
{
    private BasePointCalculator $basePointCalculator;
    private ExtraPointCalculator $extraPointCalculator;

    public function __construct()
    {
        $this->basePointCalculator = new BasePointCalculator();
        $this->extraPointCalculator = new ExtraPointCalculator();
    }

    public function calculate(array $data): int
    {
        $basePoints = $this->basePointCalculator->calculate($data);
        $extraPoints = $this->extraPointCalculator->calculate($data);

        return $basePoints + $extraPoints;
    }
}
