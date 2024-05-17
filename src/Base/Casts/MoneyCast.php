<?php

namespace Quicktane\Core\Base\Casts;

use Cknow\Money\Money;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;
use Quicktane\Core\Base\Helpers\CurrencyHelper;
use Quicktane\Core\Models\Currency;

abstract class MoneyCast implements CastsAttributes
{
    protected bool $forceDecimals = false;

    /**
     * Instantiate the class.
     *
     * @param mixed $forceDecimals
     */
    public function __construct($forceDecimals = null)
    {
        $this->forceDecimals = is_string($forceDecimals)
            ? filter_var($forceDecimals, FILTER_VALIDATE_BOOLEAN)
            : (bool) $forceDecimals;
    }

    /**
     * Get formatter.
     *
     * @return string|float|int
     */
    abstract protected function getFormatter(Money $money);

    /**
     * Transform the attribute from the underlying model values.
     *
     * @param Model $model
     * @param mixed $value
     *
     * @return Money|null
     */
    public function get($model, string $key, $value, array $attributes)
    {
        if ($value === null) {
            return null;
        }

        return Money::parse($value, $this->getCurrency($attributes), $this->forceDecimals);
    }

    /**
     * Transform the attribute to its underlying model values.
     *
     * @param Model $model
     * @param mixed $value
     *
     * @return array
     *
     * @throws \InvalidArgumentException
     */
    public function set($model, string $key, $value, array $attributes)
    {
        if ($value === null) {
            return [$key => $value];
        }

        if ($value instanceof Money) {
            // First we can try get currency from Money object
            $currency = CurrencyHelper::getCurrencyByCode($value->getCurrency()->getCode());
        }

        $currency = $currency ?? $this->getCurrency($attributes);

        try {
            $money = Money::parse($value, Money::parseCurrency($currency->code), $this->forceDecimals);
        } catch (InvalidArgumentException $e) {
            throw new InvalidArgumentException(
                sprintf('Invalid data provided for %s::$%s', get_class($model), $key)
            );
        }

        $amount = $this->getFormatter($money);

        return [$key => $amount, 'currency_id' => $currency->id];
    }

    protected function getCurrency(array $attributes): ?Currency
    {
        return CurrencyHelper::getCurrencyById($attributes['currency_id'] ?? null)
            ?? CurrencyHelper::getDefaultCurrency();
    }
}
