<?php

namespace App\Service;

use App\Model\CalculationInputModel;
use App\Service\Exception\CalculationCheckerException;
use App\Service\Interface\AlappontCalculatorInterface;
use App\Service\Interface\CalcilatorServiceInterface;
use App\Service\Interface\CalculationCheckerInterface;
use App\Service\Interface\TobbletpontCalculatorInterface;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;

class PontszmitasCalculatorService implements CalcilatorServiceInterface
{
    public function __construct(
        #[TaggedIterator('calculation.checker')] protected iterable                $checkers,
        #[TaggedIterator('calculation.calculator.alappont')] protected iterable    $alappontCalculators,
        #[TaggedIterator('calculation.calculator.tobbletpont')] protected iterable $tobbletpontCalculators
    )
    {
    }

    /** @throws CalculationCheckerException */
    public function calcucate(CalculationInputModel $inputModel): int
    {
        $result = 0;

        //Run checkers
        foreach ($this->checkers as $checker) {
            /** @var CalculationCheckerInterface $checker */
            $checker->check($inputModel);
        }

        //Alappont calculation
        $alappont = 0;

        //Az alappontszám megállapításához csak a kötelező tárgy pontértékét és a legjobban
        //sikerült kötelezően választható tárgy pontértékét kell összeadni és az így kapott
        //összeget megduplázni.
        foreach ($this->alappontCalculators as $alappontCalculator) {
            /** @var AlappontCalculatorInterface $alappontCalculator */
            $alappont += $alappontCalculator->calculate($inputModel);
        }
        $alappont *= 2;

        //Tobbletpontok
        $tobbletpont = 0;
        foreach ($this->tobbletpontCalculators as $tobbletpontCalculator) {
            /** @var TobbletpontCalculatorInterface $tobbletpontCalculator */
            $tobbletpont += $tobbletpontCalculator->calculate($inputModel);
        }
        $tobbletpont = min($tobbletpont, 100);

        $result =  $alappont + $tobbletpont;

        return $result;
    }
}
