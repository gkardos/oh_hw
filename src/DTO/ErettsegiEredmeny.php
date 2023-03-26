<?php

namespace App\DTO;

use App\Enums\ErettsegiTipus;

class ErettsegiEredmeny
{
    private string $nev;

    private ErettsegiTipus $tipus;

    private int $eredmeny;

    public function __construct(string $nev, ErettsegiTipus $tipus, int $eredmeny)
    {
        $this->nev = $nev;
        $this->tipus = $tipus;
        $this->eredmeny = $eredmeny;
    }

    public function getNev(): string
    {
        return $this->nev;
    }

    public function getTipus(): ErettsegiTipus
    {
        return $this->tipus;
    }

    public function getEredmeny(): int
    {
        return $this->eredmeny;
    }
}