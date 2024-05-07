<?php

namespace Quicktane\Core\Dto;

use Quicktane\Core\Enums\AttributeType;

class AttributeDto
{
    protected string $name;
    protected string $slug;
    protected AttributeType $type;
    protected mixed $defaultValue = null;
    protected int $position = 0;

    public function __construct(string $name, string $slug, AttributeType $type, mixed $defaultValue, int $position)
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->type = $type;
        $this->defaultValue = $defaultValue;
        $this->position = $position;
    }

    public static function fromArray(array $attributes): static
    {
        return new static(
            $attributes['name'],
            $attributes['slug'],
            $attributes['type'],
            $attributes['default_value'] ?? null,
            $attributes['position'] ?? 0
        );
    }

    public function toArray(): array
    {
        return [
            'name'         => $this->name,
            'slug'         => $this->slug,
            'type'         => $this->type,
            'default_value' => $this->defaultValue,
            'position'     => $this->position,
        ];
    }
}