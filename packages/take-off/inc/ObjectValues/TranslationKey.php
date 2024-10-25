<?php

namespace LaunchpadTakeOff\ObjectValues;

class TranslationKey extends ObjectValue
{

    protected function validate($value): void
    {
        if(! preg_match('/^[a-z]+$/', $value) ) {
            throw new InvalidValue('The value is not a translation key');
        }
    }
}
