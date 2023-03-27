<?php

namespace App\Service\Interface;

use App\Model\CalculationInputModel;
use App\Service\Exception\CalculationCheckerException;

interface CalcilatorServiceInterface
{
    /** @throws CalculationCheckerException */
    public function calcucate(CalculationInputModel $inputModel): int;
}
