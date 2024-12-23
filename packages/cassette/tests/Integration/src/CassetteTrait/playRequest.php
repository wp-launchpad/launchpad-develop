<?php

class Test_PlayRequest extends \LaunchpadCassette\Tests\Integration\TestCase {

    use CassetteTrait;

    protected $config;

	/**
	 * @dataProvider configTestData
	 */
	public function testShouldDoAsExpected($config, $expected) {

        $this->config = $config;

		$response = wp_remote_request($config['url'], $config['parameters']);

		$this->assertSame($expected['code'], wp_remote_retrieve_response_code($response));
		$this->assertSame($expected['body'], wp_remote_retrieve_body($response));
	}

    public function get_base_directory_cassettes(): string
    {
        return $this->config['root_path'];
    }

    protected function getCurrentTest(): string
    {
        return $this->getName();
    }
}