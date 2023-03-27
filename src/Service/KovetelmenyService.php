<?php

namespace App\Service;

class KovetelmenyService
{
    const KOTELZO = 1;
    const VALASZTHATO = 0;

    public function isNeedFrorCalculation(string $kar, string $szak, bool $kotelezo, string $tantargy):bool
    {
        $kovetelmeny = [
            'ELTE' => [
                'IK' => [
                    self::KOTELZO => ['matematika'],
                    self::VALASZTHATO => ['biológia', 'fizika', 'informatika', 'kémia']
                ]
            ]
        ];

        return in_array($tantargy, $kovetelmeny[$kar][$szak][intval($kotelezo)]);
    }

}
