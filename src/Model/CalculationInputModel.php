<?php

namespace App\Model;

use App\DTO\ErettsegiEredmeny;
use App\DTO\Tobbletpont;
use App\DTO\ValasztottSzak;

class CalculationInputModel
{
    private ValasztottSzak $valasztottSzak;

    /**
     * @var ErettsegiEredmeny[]
     */
    private array $erettsegiEredmenyek;

    /**
     * @var Tobbletpont[]
     */
    private array $tobbletpontok;

    public function getValasztottSzak(): ValasztottSzak
    {
        return $this->valasztottSzak;
    }

    public function setValasztottSzak(ValasztottSzak $valasztottSzak): void
    {
        $this->valasztottSzak = $valasztottSzak;
    }

    /**
     * @return ErettsegiEredmeny[]
     */
    public function getErettsegiEredmenyek(): array
    {
        return $this->erettsegiEredmenyek;
    }

    /**
     * @param ErettsegiEredmeny[] $erettsegiEredmenyek
     */
    public function setErettsegiEredmenyek(ErettsegiEredmeny ...$erettsegiEredmenyek): void
    {
        $this->erettsegiEredmenyek = $erettsegiEredmenyek;
    }

    /**
     * @return Tobbletpont[]
     */
    public function getTobbletpontok(): array
    {
        return $this->tobbletpontok;
    }

    /**
     * @param Tobbletpont[] $tobbletpontok
     */
    public function setTobbletpontok(Tobbletpont ...$tobbletpontok): void
    {
        $this->tobbletpontok = $tobbletpontok;
    }
}