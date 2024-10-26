<?php

namespace LaunchpadTakeOff\Tests\inc\Unit\inc\ObjectValues\ConstantPrefix;

use LaunchpadTakeOff\ObjectValues\ConstantPrefix;
use LaunchpadTakeOff\ObjectValues\InvalidValue;
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
        $object_value = new ConstantPrefix($config);
        $this->assertSame($config, $object_value->get_value());
    }
}
