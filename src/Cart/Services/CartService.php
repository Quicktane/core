<?php

namespace Quicktane\Core\Cart\Services;

use Quicktane\Core\Cart\Models\Cart;
use Quicktane\Core\Cart\Models\CartItem;
use Quicktane\Core\Customer\Models\Customer;
use Quicktane\Core\Models\Currency;
use Quicktane\Core\Product\Models\Product;

class CartService
{
    public function create(Customer $customer, Currency $currency)
    {
        $cart = Cart::query()->newModelInstance();
        $cart->customer()->associate($customer);
        $cart->currency()->associate($currency);
        $cart->save();

        return $cart;
    }

    public function addItem(Cart $cart, Product $product, int $quantity = 1)
    {
        $item = CartItem::query()->newModelInstance(['quantity' => $quantity]);
        $item->cart()->associate($cart);
        $item->product()->associate($product);
        $item->save();

        return $item;
    }

    public function deleteItem(Cart $cart, CartItem $item): bool
    {
        return $cart->items()->where('id', $item->id)->delete();
    }
}