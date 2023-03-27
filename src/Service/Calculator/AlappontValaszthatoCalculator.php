<?php

namespace App\Service\Calculator;

use App\Model\CalculationInputModel;
use App\Service\Exception\CalculationException;
use App\Service\Interface\AlappontCalculatorInterface;
use App\Service\KovetelmenyService;

class AlappontValaszthatoCalculator implements AlappontCalculatorInterface
{
    public function __construct(
        protected array $requiredSubjects,
        protected KovetelmenyService $kovetelmenyService
    ) {
    }

    /** @throws CalculationException */
    public function calculate(CalculationInputModel $inputModel): int
    {
        $pontszam = 0;
        foreach ($inputModel->getErettsegiEredmenyek() as $eredmeny) {
            if (!$this->kovetelmenyService->isNeedFrorCalculation(
                $inputModel->getValasztottSzak()->getEgyetem(),
                $inputModel->getValasztottSzak()->getKar(),
                false,
                $eredmeny->getNev()
            )) {
                continue;
            }

            if (!in_array($eredmeny->getNev(), $this->requiredSubjects)) {
                if ($eredmeny->getEredmeny() > $pontszam) {
                    $pontszam = $eredmeny->getEredmeny();
                }
            }
        }

        if ($pontszam === 0 ) {
            throw new CalculationException('hiba egyetlen kötelezően választható tárgyból sem
tett érettségit a hallgató, úgy a pontszámítás nem lehetséges');
        }

        return $pontszam;
    }
}
