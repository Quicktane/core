<?php

namespace Quicktane\Core\Base;

use WendellAdriel\ValidatedDTO\Concerns\EmptyCasts;
use WendellAdriel\ValidatedDTO\Concerns\EmptyDefaults;
use WendellAdriel\ValidatedDTO\Concerns\EmptyRules;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

abstract class Dto extends ValidatedDTO
{
    use EmptyRules, EmptyCasts, EmptyDefaults;
}