<?php

namespace App\Service\Calculator;

use App\Model\CalculationInputModel;
use App\Service\Exception\CalculationException;
use App\Service\Interface\AlappontCalculatorInterface;
use App\Service\KovetelmenyService;

class AlappontKotelezoCalculator implements AlappontCalculatorInterface
{
    public function __construct(
        protected array $requiredSubjects,
        protected KovetelmenyService $kovetelmenyService
    ) {
    }

    public function calculate(CalculationInputModel $inputModel): int
    {
        $pontszam = 0;
        foreach ($inputModel->getErettsegiEredmenyek() as $eredmeny) {
            if (!$this->kovetelmenyService->isNeedFrorCalculation(
                $inputModel->getValasztottSzak()->getEgyetem(),
                $inputModel->getValasztottSzak()->getKar(),
                true,
                $eredmeny->getNev()
            )) {
                continue;
            }

            if (in_array($eredmeny->getNev(), $this->requiredSubjects)) {
                $pontszam += $eredmeny->getEredmeny();
            }
        }
        return $pontszam;
    }
}
