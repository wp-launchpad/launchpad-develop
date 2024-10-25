<?php

namespace LaunchpadTakeOff\ObjectValues;

class WordPressKey extends ObjectValue
{

    protected function validate($value): void
    {
        if(! preg_match('/^[a-z]+(-[a-z]+)*$/', $value) ) {
            throw new InvalidValue('The value is not a wordpress key');
        }
    }
}
