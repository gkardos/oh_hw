<?php

namespace App\Bulder;

use App\DTO\ErettsegiEredmeny;
use App\DTO\Tobbletpont;
use App\DTO\ValasztottSzak;
use App\Enums\ErettsegiTipus;
use App\Enums\TobbletbontKategoria;
use App\Enums\TobbletbontTipus;
use App\Model\CalculationInputModel;
use InvalidArgumentException;

class CalculationInputModelBuiilder
{
    private CalculationInputModel $inputModel;

    public function __construct()
    {
        $this->reset();
    }

    public function reset(): void
    {
        $this->inputModel = new CalculationInputModel();
    }

    public function setValasztottSzakFromArray(array $valasztottSzak): void
    {
        if (empty($valasztottSzak['egyetem']) || empty($valasztottSzak['kar']) || empty($valasztottSzak['szak'])) {
            throw new InvalidArgumentException('Not all requested data is provided!');
        }

        $this->inputModel->setValasztottSzak(
            new ValasztottSzak($valasztottSzak['egyetem'], $valasztottSzak['kar'], $valasztottSzak['szak'])
        );
    }

    /**
     * @throws InvalidArgumentException
     */
    public function setErettsegiEredmenyekFromArray(array $erettsegiEredmenyek): void
    {
        $erettsegiEredmenyekObjects = [];

        foreach ($erettsegiEredmenyek as $eredmeny) {
            if (empty($eredmeny['nev']) || empty($eredmeny['tipus']) || !array_key_exists('eredmeny', $eredmeny)) {
                throw new InvalidArgumentException('Not all requested data is provided!');
            }

            $erettsegiEredmenyekObjects[] = new ErettsegiEredmeny(
                $eredmeny['nev'],
                $this->buildErettsegiTipus($eredmeny['tipus']),
                intval($eredmeny['eredmeny'])
            );
        }
        $this->inputModel->setErettsegiEredmenyek(...$erettsegiEredmenyekObjects);
    }

    /**
     * @throws InvalidArgumentException
     */
    private function buildErettsegiTipus(string $stingTipus): ErettsegiTipus
    {
        switch ($stingTipus) {
            case 'közép':
                $tipus = ErettsegiTipus::Kozep;
                break;
            case 'emelt':
                $tipus = ErettsegiTipus::Emelt;
                break;
            default:
                throw new InvalidArgumentException('Not allowed Erettsegi tipus!');
        }

        return $tipus;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function setTobbletpontokFromArray(array $tobbletpontok): void
    {
        $tobbletpontokObjects = [];

        foreach ($tobbletpontok as $tobbletpont) {

            if (empty($tobbletpont['kategoria']) || empty($tobbletpont['tipus']) || empty($tobbletpont['nyelv'])) {
                throw new InvalidArgumentException('Not all requested data is provided!');
            }

            $tobbletpontokObjects[] = new Tobbletpont(
                $this->buildTobbletpontKategoria($tobbletpont['kategoria']),
                $this->buildTobbletpontTipus($tobbletpont['tipus']),
                $tobbletpont['nyelv']
            );
        }
        $this->inputModel->setTobbletpontok(...$tobbletpontokObjects);
    }

    /**
     * @throws InvalidArgumentException
     */
    private function buildTobbletpontKategoria(string $kategoriaString): TobbletbontKategoria
    {
        if ($kategoriaString == 'Nyelvvizsga') {
             return TobbletbontKategoria::Nyelvvizsga;
        } else {
            throw new InvalidArgumentException('Not allowed Tobbletpont kategoria!');
        }
    }

    /**
     * @throws InvalidArgumentException
     */
    private function buildTobbletpontTipus(string $tipusString): TobbletbontTipus
    {
        switch ($tipusString) {
            case 'B2':
                $tipus = TobbletbontTipus::B2;
                break;
            case 'C1':
                $tipus = TobbletbontTipus::C1;
                break;
            default:
                throw new InvalidArgumentException('Not allowed tobbletpont tipus!');
        }

        return $tipus;
    }

    public function getInputModel(): CalculationInputModel
    {
        $model = $this->inputModel;
        $this->reset();
        return $model;
    }
}
