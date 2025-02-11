<?php

namespace App\Services\PointCalculator;

use App\ValueObject\Input\InputVO;

interface PointCalculatorInterface
{
    public function calculate(InputVO $input): int;
}
