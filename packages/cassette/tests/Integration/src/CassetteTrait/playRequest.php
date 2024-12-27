<?php
namespace LaunchpadCassette\Tests\Integration\src\CassetteTrait;

use LaunchpadCassette\CassetteTrait;

class Test_PlayRequest extends \LaunchpadCassette\Tests\Integration\TestCase {
    protected $config;

	public function set_up() {
		parent::set_up();
        $this->register_cassette();
	}

    public function tear_down()
    {
        $this->unregister_cassette();
        parent::tear_down();
    }

    /**
	 * @dataProvider configTestData
	 */
	public function testShouldDoAsExpected($config, $expected) {
        $this->config = $config;

		$response = wp_remote_request($config['url'], $config['parameters']);
		$second_response = wp_remote_request($config['url'], $config['parameters']);

		$this->assertSame($expected['code'], wp_remote_retrieve_response_code($response));
		$this->assertSame($expected['body'], wp_remote_retrieve_body($response));
        if(key_exists('second_body', $expected)) {
            $this->assertSame($expected['second_body'], wp_remote_retrieve_body($second_response));
        }

	}

    public function get_base_directory_cassettes(): string
    {
        return ROCKER_LAUNCHER_DATABASE_TESTS_CASSETTES_DIR . '/';
    }

    protected function getCurrentTest(): string
    {
        return $this->getName();
    }
}