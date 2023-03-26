<?php

namespace App\Bulder;

use App\DTO\ErettsegiEredmeny;
use App\DTO\ValasztottSzak;
use App\Enums\ErettsegiTipus;
use App\Model\CalculationInputModel;

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
            throw new \InvalidArgumentException('Not all requested data is provided!');
        }

        $this->inputModel->setValasztottSzak(
            new ValasztottSzak($valasztottSzak['egyetem'],$valasztottSzak['kar'], $valasztottSzak['szak'])
        );
    }

    /**
     * @throws \InvalidArgumentException
     */
    public function setErettsegiEredmenyekFromArray(array $erettsegiEredmenyek): void
    {
        $erettsegiEredmenyek = [];

        foreach ($erettsegiEredmenyek as $eredmeny) {
            if (empty($eredmeny['nev']) || empty( $eredmeny['tipus']) || !array_key_exists('eredmeny', $eredmeny)) {
                throw new \InvalidArgumentException('Not all requested data is provided!');
            }

            $erettsegiEredmenyek[] = new ErettsegiEredmeny(
                $eredmeny['nev'],
                $this->buildErettsegiTipus($eredmeny['tipus']),
                intval($eredmeny['eredmeny'])
            );
        }
        $this->inputModel->setErettsegiEredmenyek(...$erettsegiEredmenyek);
      }

    /**
     * @throws \InvalidArgumentException
     */
      private function buildErettsegiTipus(string $stingTipus): ErettsegiTipus
      {
          switch ($stingTipus) {
              case 'közép': $tipus = ErettsegiTipus::Kozep;
                  break;
              case 'emelt': $tipus= ErettsegiTipus::Emelt;
                  break;
              default:
                  throw new \InvalidArgumentException('Not allowed Erettsegi tipus!');
          }

          return $tipus;
      }

      public function setTobbletpontokFromArray(array $tobbletpontok): void
      {

      }


}