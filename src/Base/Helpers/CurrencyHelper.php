<?php

namespace Quicktane\Core\Base\Helpers;

use Quicktane\Core\Models\Currency as CurrencyModel;

class CurrencyHelper
{
    public static function getCurrencyByCode(string $code): CurrencyModel
    {
        if (!($currency = CurrencyModel::query()->where('code', $code)->first())) {
            //todo create custom exception
            throw new \Exception('Unsupported currency code: '.$code);
        }

        return $currency;
    }

    public static function getCurrencyById(?int $id): CurrencyModel
    {
        if (!($currency = CurrencyModel::query()->find($id))) {
            //todo create custom exception
            throw new \Exception("Currency with ID [$id] not found");
        }

        return $currency;
    }

    public static function getDefaultCurrency(): CurrencyModel
    {
        //todo move it to cache
        if (!($currency = CurrencyModel::query()->where('default', true)->first())) {
            //todo create custom exception
            throw new \Exception('The system doesn\'t have a default currency');
        }

        return $currency;
    }
}