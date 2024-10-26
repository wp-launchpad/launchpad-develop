<?php

namespace LaunchpadTakeOff\ObjectValues;

class PS4Namespace extends ObjectValue
{

    protected function validate($value): void
    {
        if(! preg_match( '/^([A-Za-z0-9]+\\\\)*[A-Za-z0-9]+\\\\?$/', $value)) {
            throw new InvalidValue('The value is not a valid PSR4 namespace');
        }
    }
}
