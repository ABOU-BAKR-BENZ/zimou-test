<?php


namespace App\Enums;

enum DeliveryTypeEnum: string
{
    case STANDARD = 'standard';
    case EXPRESS = 'express';
    case SAMEDAY = 'same day';


    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }
}
