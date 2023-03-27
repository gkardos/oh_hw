<?php

namespace App\Service\Interface;

use App\Model\CalculationInputModel;
use App\Service\Exception\CalculationException;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag('calculation.checker')]
interface CalculationCheckerInterface
{
    /** @throws CalculationException */
    public function check(CalculationInputModel $inputModel): bool;
}
