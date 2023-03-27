<?php

namespace App\Service\Interface;

use App\Model\CalculationInputModel;
use App\Service\Exception\CalculationCheckerException;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag('calculation.checker')]
interface CalculationCheckerInterface
{
    /** @throws CalculationCheckerException */
    public function check(CalculationInputModel $inputModel): bool;
}
