<?php

namespace LaunchpadBuild\Steps;

interface StepInterface
{
    public function __invoke($payload): array;

    public function get_id(): string;
}