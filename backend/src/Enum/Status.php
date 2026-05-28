<?php

namespace App\Enum;

enum Status: string
{
    case Preparing = 'preparing';
    case Paid = 'paid';
}