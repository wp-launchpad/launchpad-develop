<?php

namespace LaunchpadBusTakeOff\Tests\Integration\inc\Commands\MakeCommandCommand;

use LaunchpadBusTakeOff\Tests\Integration\TestCase;

/**
 * @covers \LaunchpadBusTakeOff\Commands\MakeCommandCommand::execute
 */
class Test_execute extends TestCase {

    /**
     * @dataProvider configTestData
     */
    public function testShouldDoAsExpected( $config, $expected )
    {
        self::assertFalse($this->filesystem->exists($expected['command_path']));
        self::assertFalse($this->filesystem->exists($expected['command_handler_path']));
        $this->launch_app("bus:make:command {$config['class']}");
        self::assertTrue($this->filesystem->exists($expected['command_path']));
        self::assertTrue($this->filesystem->exists($expected['command_handler_path']));
        self::assertSame($expected['command_content'], $this->filesystem->get_contents($config['command_path']));
        self::assertSame($expected['command_handler_content'], $this->filesystem->get_contents($config['command_handler_path']));
    }
}
