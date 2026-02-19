<?php

namespace App\Enum;

enum GiftStatusEnum: string
{
    case CREATED = 'Создан';
    case USER_ASSIGNED = 'Назначен пользователь';
    case TRANSFERRED_TO_DELIVERY_SERVICE = 'Передан в службу доставки';
    case DELIVERED = 'Доставлен';
}
