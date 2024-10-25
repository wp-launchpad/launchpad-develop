<?php

namespace LaunchpadConstants\Sanitizers;

use LaunchpadDispatcher\Interfaces\SanitizerInterface;

class AnySanitizer implements SanitizerInterface
{

    public function sanitize($value)
    {
        return $value;
    }

    public function is_default($value, $original): bool
    {
        return false;
    }
}