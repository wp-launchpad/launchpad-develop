<?php

class Test_PlayRequest extends \LaunchpadCassette\Tests\Integration\TestCase {
	/**
	 * @dataProvider configTestData
	 */
	public function testShouldDoAsExpected($config, $expected) {
		$response = wp_remote_request($config['url'], $config['parameters']);

		$this->assertSame($expected['code'], wp_remote_retrieve_response_code($response));
		$this->assertSame($expected['body'], wp_remote_retrieve_response_code($response));
	}
}