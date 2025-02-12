<?php

namespace App\Http\Controllers;

use App\Exceptions\AbstractCalculatorException;
use App\Http\Requests\CalculatePointsRequest;
use App\Services\PointCalculator\PointCalculator;
use App\ValueObject\Input\InputVO;
use Symfony\Component\HttpFoundation\Response;

class CalculatorController extends Controller
{
    private PointCalculator $pointCalculator;
    public function __construct() {
        $this->pointCalculator = new PointCalculator();
    }

    /**
     * Calculate points.
     *
     */
    public function __invoke(CalculatePointsRequest $request): Response
    {
        try {
            $input = InputVO::create($request->all());
            $point = $this->pointCalculator->calculate($input);
        } catch (AbstractCalculatorException $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 409);
        }

        return response()->json(['osszpontszam' => $point]);
    }
}
