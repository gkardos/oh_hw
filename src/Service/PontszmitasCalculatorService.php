<?php

namespace App\Service;

use App\Model\CalculationInputModel;
use App\Service\Exception\CalculationException;
use App\Service\Interface\CalcilatorServiceInterface;

class PontszmitasCalculatorService implements CalcilatorServiceInterface
{

    /** @throws CalculationException */
    public function calcucate(CalculationInputModel $inputModel): int
    {
        $result = 0;
        // TODO: Implement calcucate() method.

        return $result;
    }
}
