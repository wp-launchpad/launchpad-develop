<?php

namespace LaunchpadTakeOff\Tests\inc\Unit\inc\ObjectValues\WordPressKey;

use LaunchpadTakeOff\ObjectValues\InvalidValue;
use LaunchpadTakeOff\ObjectValues\WordPressKey;
use LaunchpadTakeOff\Tests\Unit\TestCase;

class Test_Validate extends TestCase
{
    /**
     * @dataProvider configTestData
     */
    public function testShouldDoAsExpected($config, $expected) {
        if( ! $expected ) {
            $this->expectException(InvalidValue::class);
        }
        $object_value = new WordPressKey($config);
        $this->assertSame($config, $object_value->get_value());
    }
}
