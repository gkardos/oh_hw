<?php

namespace App\Service\Checker;

use App\Model\CalculationInputModel;
use App\Service\Exception\CalculationException;
use App\Service\Interface\CalculationCheckerInterface;

class MinimalResultCalculationChecker implements CalculationCheckerInterface
{
    const MIN_RESULT = 20;

    public function check(CalculationInputModel $inputModel): bool
    {
       foreach ($inputModel->getErettsegiEredmenyek() as $eredmeny) {
           if ($eredmeny->getEredmeny() < self::MIN_RESULT) {
              throw new CalculationException(
                  sprintf('hiba, nem lehetséges a pontszámítás a %s tárgyból elért %d%% alatti eredmény miatt',
                    $eredmeny->getNev(),
                    self::MIN_RESULT
                  )
              );
           }
       }

       return true;
    }
}
