<?php

namespace LaunchpadTakeOff\ObjectValues;

class Version extends ObjectValue
{

    protected function validate($value): void
    {
        if(! preg_match('/^(\d+\.)*\d+$/', $value)) {
            throw new InvalidValue('The value is not a version');
        }
    }
}
