<?php

namespace LaunchpadTakeOff\ObjectValues;

class URL extends ObjectValue
{

    protected function validate($value): void
    {
        if( ! filter_var($value, FILTER_VALIDATE_URL)) {
            throw new InvalidValue('The value is not a URL');
        }
    }
}
