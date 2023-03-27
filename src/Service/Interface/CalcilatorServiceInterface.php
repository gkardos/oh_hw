<?php

namespace App\Service\Interface;

use App\Model\CalculationInputModel;
use App\Service\Exception\CalculationException;

interface CalcilatorServiceInterface
{
    /** @throws CalculationException */
    public function calcucate(CalculationInputModel $inputModel): int;
}
