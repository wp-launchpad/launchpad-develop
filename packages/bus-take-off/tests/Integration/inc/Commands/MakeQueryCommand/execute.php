<?php

namespace LaunchpadBusTakeOff\Tests\Integration\inc\Commands\MakeQueryCommand;

use LaunchpadBusTakeOff\Tests\Integration\TestCase;

/**
 * @covers \LaunchpadBusTakeOff\Commands\MakeQueryCommand::execute
 */
class Test_execute extends TestCase {

    /**
     * @dataProvider configTestData
     */
    public function testShouldDoAsExpected( $config, $expected )
    {
        self::assertFalse($this->filesystem->exists($expected['query_path']));
        self::assertFalse($this->filesystem->exists($expected['query_handler_path']));
        self::assertFalse($this->filesystem->exists($expected['query_result_path']));
        $this->launch_app("bus:make:query {$config['class']}");
        self::assertTrue($this->filesystem->exists($expected['query_path']));
        self::assertTrue($this->filesystem->exists($expected['query_handler_path']));
        self::assertTrue($this->filesystem->exists($expected['query_result_path']));
        self::assertSame($expected['query_content'], $this->filesystem->get_contents($expected['query_path']));
        self::assertSame($expected['query_handler_content'], $this->filesystem->get_contents($config['query_handler_path']));
        self::assertSame($expected['query_result_content'], $this->filesystem->get_contents($config['query_result_path']));

    }
}
