<?php

namespace App\DTO;

class ValasztottSzak
{
    private string $egyetem;

    private string $kar;

    private string $szak;

    public function __construct(string $egyetem, string $kar, string $szak)
    {
        $this->egyetem = $egyetem;
        $this->kar = $kar;
        $this->szak = $szak;
    }

    public function getEgyetem(): string
    {
        return $this->egyetem;
    }

    public function getKar(): string
    {
        return $this->kar;
    }

    public function getSzak(): string
    {
        return $this->szak;
    }
}