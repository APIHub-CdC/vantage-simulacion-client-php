<?php

namespace VantageSimulacion\Client\Model;
use \VantageSimulacion\Client\ObjectSerializer;

class CatalogoResidencia
{
    
    const 1 = 1;
    const 2 = 2;
    const 3 = 3;
    const 4 = 4;
    const 5 = 5;
    
    
    public static function getAllowableEnumValues()
    {
        return [
            self::1,
            self::2,
            self::3,
            self::4,
            self::5,
        ];
    }
}
