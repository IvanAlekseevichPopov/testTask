<?php

declare(strict_types=1);

namespace App\Validator\Constraint;

class ConstraintLimits
{
    public const MAX_INPUT_LENGTH = 255;
    public const MAX_TEXT_LENGTH = 65535;

    private function __construct()
    {
    }
}
