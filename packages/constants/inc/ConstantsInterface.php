<?php

namespace LaunchpadConstants;

interface ConstantsInterface
{
    public function has(string $name): bool;

    public function get(string $name);

    public function set(string $name, $value);
}