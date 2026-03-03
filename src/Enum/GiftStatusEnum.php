<?php

namespace App\Enum;

enum GiftStatusEnum: string
{
    case CREATED = 'created';
    case USER_ASSIGNED = 'user_assigned';
    case TRANSFERRED_TO_DELIVERY_SERVICE = 'transferred_to_delivery_service';
    case DELIVERED = 'delivered';
}
