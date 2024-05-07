<?php

namespace Quicktane\Core\Dto;

use Quicktane\Core\Enums\ProductType;

class ProductDto
{
    protected ProductType $type;
    protected string $sku;
    protected int $quantity;

    protected int $attributeGroup;
    protected array $attributes = [];

    public function __construct(
        ProductType $type,
        string $sku,
        int $quantity,
        int $attributeGroup,
        array $attributes
    ) {
        $this->type = $type;
        $this->sku = $sku;
        $this->quantity = $quantity;
        $this->attributeGroup = $attributeGroup;
        $this->attributes = $attributes;
    }

    public static function fromArray(array $data): static
    {
        return new static(
            $data['type'],
            $data['sku'],
            $data['quantity'],
            $data['attribute_group'],
            $data['attributes']
        );
    }

    public function getAttributeGroup(): int
    {
        return $this->attributeGroup;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function toArray(): array
    {
        return [
            'type'     => $this->type,
            'sku'      => $this->sku,
            'quantity' => $this->quantity,
        ];
    }
}