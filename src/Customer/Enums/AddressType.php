<?php

namespace Quicktane\Core\Customer\Enums;

enum AddressType: string
{
    case BILLING = 'billing';
    case SHIPPING = 'shipping';
}