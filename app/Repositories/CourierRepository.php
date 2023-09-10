<?php

namespace App\Repositories;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

class CourierRepository
{
    public function courier()
    {
        $data =  [
            'pos',
            'tiki',
            'jne',
            'pcp',
            'esl',
            'pandu',
            'wahana',
            'jnt',
            'pahala',
            'cahaya',
            'sap',
            'jet',
            'indah',
            'dse',
            'slis',
            'first',
            'ncs',
            'star'
        ];
        return $data;
    }
}
