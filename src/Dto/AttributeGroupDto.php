<?php

namespace Quicktane\Core\Dto;

class AttributeGroupDto
{
    protected string $name;
    protected string $slug;
    protected int $position = 0;
    /**
     * @var array<int>
     */
    protected array $attributes = [];

    public function __construct(string $name, string $slug, int $position, array $attributes)
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->position = $position;
        $this->attributes = $attributes;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public static function fromArray(array $attributes): static
    {
        return new static(
            $attributes['name'],
            $attributes['slug'],
            $attributes['position'] ?? 0,
            $attributes['attributes'] ?? []
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'position' => $this->position,
        ];
    }
}