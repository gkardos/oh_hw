<?php

namespace App\Service;

use App\Model\CalculationInputModel;
use App\Service\Exception\CalculationException;
use App\Service\Interface\CalcilatorServiceInterface;
use App\Service\Interface\CalculationCheckerInterface;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;

class PontszmitasCalculatorService implements CalcilatorServiceInterface
{
    public function __construct(
        #[TaggedIterator('app.handler')] protected iterable $checkers
    ) {
    }

    /** @throws CalculationException */
    public function calcucate(CalculationInputModel $inputModel): int
    {
        $result = 0;

        foreach ($this->checkers as $checker) {
            /** @var CalculationCheckerInterface $checker */
            $checker->check($inputModel);
        }

        return $result;
    }
}
