<?php

namespace App\Services\PointCalculator;

interface PointCalculatorInterface
{
    public function calculate(array $data): int;
}
