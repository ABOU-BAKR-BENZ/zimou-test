<?php


namespace App\Enums;

enum PackageStatusEnum: string
{
    case PENDING = 'pending';
    case IN_TRANSIT = 'in transit';
    case ARRIVED_AT_DESTINATION = 'arrived at destination';
    case OUT_FOR_DELIVERY = 'out for delivery';
    case DELIVERED = 'delivered';
    case RETURN_TO_SENDER = 'return to sender';
    case EXCEPTION = 'exception';
    case DELAYED = 'delayed';
    case LOST = 'lost';


    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }
}
