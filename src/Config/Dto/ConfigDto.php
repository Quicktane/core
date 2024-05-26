<?php

namespace Quicktane\Core\Config\Dto;

use Quicktane\Core\Base\Dto;
use Quicktane\Core\Config\Enums\ConfigKey;
use WendellAdriel\ValidatedDTO\Attributes\Cast;
use WendellAdriel\ValidatedDTO\Attributes\Rules;
use WendellAdriel\ValidatedDTO\Casting\EnumCast;

class ConfigDto extends Dto
{
    #[Rules(['required'])]
    #[Cast(EnumCast::class, ConfigKey::class)]
    public ConfigKey $key;

    #[Rules(['required', 'string'])]
    public string $value;
}
