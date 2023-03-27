<?php

namespace App\Service\Checker;

use App\Model\CalculationInputModel;
use App\Service\Exception\CalculationException;
use App\Service\Interface\CalculationCheckerInterface;

class RequiredSubjectsCalculationChecker implements CalculationCheckerInterface
{

    public function check(CalculationInputModel $inputModel): bool
    {
        $requiredSubjects = ['magyar nyelv és irodalom', 'történelem', 'matematika'] ;
        $actualSubjects = [];

        foreach ($inputModel->getErettsegiEredmenyek() as $eredmeny) {
            $actualSubjects[] = $eredmeny->getNev();
        }

        if (!empty(array_diff($requiredSubjects, $actualSubjects))) {
            throw new CalculationException('hiba, nem lehetséges a pontszámítás a kötelező érettségi tárgyak hiánya miatt');
        }

        return true;
    }
}
