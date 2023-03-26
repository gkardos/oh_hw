<?php

namespace App\Tests\Bulder;

use App\Bulder\CalculationInputModelBuiilder;
use App\DTO\ErettsegiEredmeny;
use App\DTO\Tobbletpont;
use App\DTO\ValasztottSzak;
use App\Enums\ErettsegiTipus;
use PHPUnit\Framework\TestCase;

class CalculationInputModelBuiilderTest extends TestCase
{
    public function testBuild()
    {
        //Given
        $object = new CalculationInputModelBuiilder();

        //When
        $data = $this->getExampleData();

        $object->setValasztottSzakFromArray($data['valasztott-szak']);
        $object->setErettsegiEredmenyekFromArray($data['erettsegi-eredmenyek']);
        $object->setTobbletpontokFromArray($data['tobbletpontok']);

        $inputModel = $object->getInputModel();

        //Then
        $this->assertInstanceOf(ValasztottSzak::class, $inputModel->getValasztottSzak());
        $this->assertEquals( $data['valasztott-szak'][ 'egyetem'], $inputModel->getValasztottSzak()->getEgyetem());

        $erettsegiEredmeny = $inputModel->getErettsegiEredmenyek()[0];
        $this->assertInstanceOf(ErettsegiEredmeny::class, $erettsegiEredmeny);
        $this->assertEquals('közép', $erettsegiEredmeny->getTipus()->value);
        $this->assertEquals(70, $erettsegiEredmeny->getEredmeny());

        $this->assertInstanceOf(Tobbletpont::class, $inputModel->getTobbletpontok()[0]);

    }

    private function getExampleData():  array
    {
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


}
