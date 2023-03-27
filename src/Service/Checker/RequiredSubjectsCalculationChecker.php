<?php

namespace App\Service\Checker;

use App\Model\CalculationInputModel;
use App\Service\Exception\CalculationCheckerException;
use App\Service\Interface\CalculationCheckerInterface;

class RequiredSubjectsCalculationChecker implements CalculationCheckerInterface
{

    public function __construct(protected array $requiredSubjects)
     {
    }

    public function check(CalculationInputModel $inputModel): bool
    {
        $actualSubjects = [];

        foreach ($inputModel->getErettsegiEredmenyek() as $eredmeny) {
            $actualSubjects[] = $eredmeny->getNev();
        }

        if (!empty(array_diff($this->requiredSubjects, $actualSubjects))) {
            throw new CalculationCheckerException('hiba, nem lehetséges a pontszámítás a kötelező érettségi tárgyak hiánya miatt');
        }

        return true;
    }
}
