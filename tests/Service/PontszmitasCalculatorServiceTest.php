<?php

namespace App\Tests\Service;

use App\Bulder\CalculationInputModelBuiilder;
use App\Model\CalculationInputModel;
use App\Service\Checker\MinimalResultCalcilationChecker;
use App\Service\Exception\CalculationException;
use App\Service\PontszmitasCalculatorService;
use PHPUnit\Framework\TestCase;

class PontszmitasCalculatorServiceTest extends TestCase
{

    private CalculationInputModelBuiilder $builder;

    protected function setUp(): void
    {
        $this->builder = new CalculationInputModelBuiilder();
        parent::setUp();
    }

    public function testSucdcessfulCalculationWithResult470()
    {
        //Given
        $object = $this->getObject();
        $inputModel = $this->buildInputModel($this->getData1());

        //When
        $result = $object->calcucate($inputModel);

        //Than
        $this->assertEquals(470, $result);
    }

    public function testSucdcessfulCalculationWithResult476()
    {
        //Given
        $object = $this->getObject();
        $inputModel = $this->buildInputModel($this->getData2());

        //When
        $result = $object->calcucate($inputModel);

        //Then
        $this->assertEquals(476, $result);
    }

    public function testUnsucdcessfulCalculationBecouseOfMissingSubject()
    {
        //Given
        $object = $this->getObject();
        $inputModel = $this->buildInputModel($this->getData3());

        //Then
        $this->expectException(CalculationException::class);
        $this->expectExceptionMessage('hiba, nem lehetséges a pontszámítás a kötelező érettségi tárgyak hiánya miatt');

        //When
        $result = $object->calcucate($inputModel);
    }

    public function testUnsucdcessfulCalculationBecouseOfLowResult()
    {
        //Given
        $object = $this->getObject();
        $inputModel = $this->buildInputModel($this->getData4());

        //Then
        $this->expectException(CalculationException::class);
        $this->expectExceptionMessage('hiba, nem lehetséges a pontszámítás a magyar nyelv és irodalom tárgyból elért 20% alatti eredmény miatt');

        //When
        $result = $object->calcucate($inputModel);
    }

    private function getObject(): PontszmitasCalculatorService
    {
        return new PontszmitasCalculatorService(
            [
                new MinimalResultCalcilationChecker()
            ]
        );
    }

    private function buildInputModel($data): CalculationInputModel
    {
        $this->builder->setValasztottSzakFromArray($data['valasztott-szak']);
        $this->builder->setErettsegiEredmenyekFromArray($data['erettsegi-eredmenyek']);
        $this->builder->setTobbletpontokFromArray($data['tobbletpontok']);

        return $this->builder->getInputModel();
    }

    private function getData1()
    {
        // output: 470 (370 alappont + 100 többletpont)
        $exampleData = [
            'valasztott-szak' => [
                'egyetem' => 'ELTE',
                'kar' => 'IK',
                'szak' => 'Programtervező informatikus',
            ],
            'erettsegi-eredmenyek' => [
                [
                    'nev' => 'magyar nyelv és irodalom',
                    'tipus' => 'közép',
                    'eredmeny' => '70%',
                ],
                [
                    'nev' => 'történelem',
                    'tipus' => 'közép',
                    'eredmeny' => '80%',
                ],
                [
                    'nev' => 'matematika',
                    'tipus' => 'emelt',
                    'eredmeny' => '90%',
                ],
                [
                    'nev' => 'angol nyelv',
                    'tipus' => 'közép',
                    'eredmeny' => '94%',
                ],
                [
                    'nev' => 'informatika',
                    'tipus' => 'közép',
                    'eredmeny' => '95%',
                ],
            ],
            'tobbletpontok' => [
                [
                    'kategoria' => 'Nyelvvizsga',
                    'tipus' => 'B2',
                    'nyelv' => 'angol',
                ],
                [
                    'kategoria' => 'Nyelvvizsga',
                    'tipus' => 'C1',
                    'nyelv' => 'német',
                ],
            ],
        ];
        return $exampleData;
    }
    private function getData2()
    {
// output: 476 (376 alappont + 100 többletpont)
        $exampleData = [
            'valasztott-szak' => [
                'egyetem' => 'ELTE',
                'kar' => 'IK',
                'szak' => 'Programtervező informatikus',
            ],
            'erettsegi-eredmenyek' => [
                [
                    'nev' => 'magyar nyelv és irodalom',
                    'tipus' => 'közép',
                    'eredmeny' => '70%',
                ],
                [
                    'nev' => 'történelem',
                    'tipus' => 'közép',
                    'eredmeny' => '80%',
                ],
                [
                    'nev' => 'matematika',
                    'tipus' => 'emelt',
                    'eredmeny' => '90%',
                ],
                [
                    'nev' => 'angol nyelv',
                    'tipus' => 'közép',
                    'eredmeny' => '94%',
                ],
                [
                    'nev' => 'informatika',
                    'tipus' => 'közép',
                    'eredmeny' => '95%',
                ],
                [
                    'nev' => 'fizika',
                    'tipus' => 'közép',
                    'eredmeny' => '98%',
                ],
            ],
            'tobbletpontok' => [
                [
                    'kategoria' => 'Nyelvvizsga',
                    'tipus' => 'B2',
                    'nyelv' => 'angol',
                ],
                [
                    'kategoria' => 'Nyelvvizsga',
                    'tipus' => 'C1',
                    'nyelv' => 'német',
                ],
            ],
        ];

        return $exampleData;
    }

    private function getData3()
    {

// output: hiba, nem lehetséges a pontszámítás a kötelező érettségi tárgyak hiánya miatt
        $exampleData2 = [
            'valasztott-szak' => [
                'egyetem' => 'ELTE',
                'kar' => 'IK',
                'szak' => 'Programtervező informatikus',
            ],
            'erettsegi-eredmenyek' => [
                [
                    'nev' => 'matematika',
                    'tipus' => 'emelt',
                    'eredmeny' => '90%',
                ],
                [
                    'nev' => 'angol nyelv',
                    'tipus' => 'közép',
                    'eredmeny' => '94%',
                ],
                [
                    'nev' => 'informatika',
                    'tipus' => 'közép',
                    'eredmeny' => '95%',
                ],
            ],
            'tobbletpontok' => [
                [
                    'kategoria' => 'Nyelvvizsga',
                    'tipus' => 'B2',
                    'nyelv' => 'angol',
                ],
                [
                    'kategoria' => 'Nyelvvizsga',
                    'tipus' => 'C1',
                    'nyelv' => 'német',
                ],
            ],
        ];
        return $exampleData2;
    }

    private function getData4()
    {

// output: hiba, nem lehetséges a pontszámítás a magyar nyelv és irodalom tárgyból elért 20% alatti eredmény miatt
        $exampleData3 = [
            'valasztott-szak' => [
                'egyetem' => 'ELTE',
                'kar' => 'IK',
                'szak' => 'Programtervező informatikus',
            ],
            'erettsegi-eredmenyek' => [
                [
                    'nev' => 'magyar nyelv és irodalom',
                    'tipus' => 'közép',
                    'eredmeny' => '15%',
                ],
                [
                    'nev' => 'történelem',
                    'tipus' => 'közép',
                    'eredmeny' => '80%',
                ],
                [
                    'nev' => 'matematika',
                    'tipus' => 'emelt',
                    'eredmeny' => '90%',
                ],
                [
                    'nev' => 'angol nyelv',
                    'tipus' => 'közép',
                    'eredmeny' => '94%',
                ],
                [
                    'nev' => 'informatika',
                    'tipus' => 'közép',
                    'eredmeny' => '95%',
                ],
            ],
            'tobbletpontok' => [
                [
                    'kategoria' => 'Nyelvvizsga',
                    'tipus' => 'B2',
                    'nyelv' => 'angol',
                ],
                [
                    'kategoria' => 'Nyelvvizsga',
                    'tipus' => 'C1',
                    'nyelv' => 'német',
                ],
            ],
        ];

        return $exampleData3;
    }

}
