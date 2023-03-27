<?php

namespace App\Service\Interface;

use App\Model\CalculationInputModel;
use App\Service\Exception\CalculationException;

interface CalculatorInterface
{
    /** @throws CalculationException */
    public function calculate(CalculationInputModel $inputModel): int;

}
