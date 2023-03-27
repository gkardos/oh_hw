<?php

namespace App\Service\Calculator;

use App\Model\CalculationInputModel;
use App\Service\Interface\TobbletpontCalculatorInterface;
use App\Service\KovetelmenyService;

class TobbletpontNyelvCalculator implements TobbletpontCalculatorInterface
{

    public function calculate(CalculationInputModel $inputModel): int
    {
        $nyelvvizsgaPontok = [
            'B2' => 28,
            'C1' => 40
        ];

        $result = [];
        foreach ($inputModel->getTobbletpontok() as $tobbletpont) {
            if ($tobbletpont->getKategoria()->value == 'Nyelvvizsga') {
                if (
                    (!empty($result[$tobbletpont->getNyelv()])
                        && $result[$tobbletpont->getNyelv()] < $nyelvvizsgaPontok[$tobbletpont->getTipus()->value]
                    )
                    || empty($result[$tobbletpont->getNyelv()])
                ) {
                    $result[$tobbletpont->getNyelv()] = $nyelvvizsgaPontok[$tobbletpont->getTipus()->value];
                }
            }
        }

        $sumResult = 0;
        foreach ($result as $value) {
            $sumResult += $value;
        }

        return $sumResult;
    }
}
