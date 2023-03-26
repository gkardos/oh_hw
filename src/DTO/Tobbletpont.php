<?php

namespace App\DTO;

use App\Enums\TobbletbontKategoria;
use App\Enums\TobbletbontTipus;

class Tobbletpont
{
    private TobbletbontKategoria $kategoria;

    private TobbletbontTipus $tipus;

    private string $nyelv;

    public function __construct(TobbletbontKategoria $kategoria, TobbletbontTipus $tipus, string $nyelv)
    {
        $this->kategoria = $kategoria;
        $this->tipus = $tipus;
        $this->nyelv = $nyelv;
    }

    public function getKategoria(): TobbletbontKategoria
    {
        return $this->kategoria;
    }

    public function getTipus(): TobbletbontTipus
    {
        return $this->tipus;
    }

    public function getNyelv(): string
    {
        return $this->nyelv;
    }
}