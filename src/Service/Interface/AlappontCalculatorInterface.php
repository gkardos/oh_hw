<?php

namespace App\Service\Interface;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag('calculation.calculator.alappont')]
interface AlappontCalculatorInterface extends CalculatorInterface
{}
