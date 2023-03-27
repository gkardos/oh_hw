<?php

namespace App\Service\Interface;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag('calculation.calculator.tobbletpont')]
interface TobbletpontCalculatorInterface extends CalculatorInterface
{

}
