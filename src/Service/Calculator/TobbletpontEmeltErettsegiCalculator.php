<?php

namespace App\Service\Calculator;

use App\Enums\ErettsegiTipus;
use App\Model\CalculationInputModel;
use App\Service\Exception\CalculationException;
use App\Service\Interface\TobbletpontCalculatorInterface;
use App\Service\KovetelmenyService;

class TobbletpontEmeltErettsegiCalculator implements TobbletpontCalculatorInterface
{

    public function __construct(
        protected KovetelmenyService $kovetelmenyService
    ) {
    }

    public function calculate(CalculationInputModel $inputModel): int
    {
        $result = 0;
        foreach ($inputModel->getErettsegiEredmenyek() as $eredmeny) {

            if ($eredmeny->getTipus() == ErettsegiTipus::Emelt) {
                $result += 50;
            }
        }

        return $result;
    }
}
