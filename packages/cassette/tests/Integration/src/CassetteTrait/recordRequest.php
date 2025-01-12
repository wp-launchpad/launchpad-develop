<?php

namespace LaunchpadCassette\Tests\Integration\src\CassetteTrait;

use LaunchpadCassette\Tests\Integration\TestCase;

class Test_recordRequest extends TestCase {
	protected $config;
	protected $expected;

	public function set_up() {
		parent::set_up();
		$this->register_cassette();
	}

	public function tear_down()
	{
		unlink($this->expected['path']);
		if($this->recorder) {
			$this->unregister_cassette();
		}
		parent::tear_down();
	}

	/**
	 * @dataProvider configTestData
	 */
	public function testShouldDoAsExpected($config, $expected) {
		$this->config = $config;
		$this->expected = $expected;

		$folder = dirname($expected['path']);

		if( ! is_dir($folder)) {
			mkdir($folder, true);
		}

		if(key_exists('content', $config)) {
			file_put_contents($expected['path'], $config['content']);
		}

		$response = wp_remote_request($config['url'], $config['parameters']);

		if(key_exists('second_response', $config)) {
			wp_remote_request($config['second_url'], $config['parameters']);
		}

		$this->assertSame($expected['code'], wp_remote_retrieve_response_code($response));
		$this->assertSame($expected['body'], wp_remote_retrieve_body($response));

		$this->unregister_cassette();

		$this->assertTrue(is_file($expected['path']));
		$this->assertSame($expected['content'], file_get_contents($expected['path']));

	}

	public function get_base_directory_cassettes(): string
	{
		return ROCKER_LAUNCHER_DATABASE_TESTS_CASSETTES_DIR . '/';
	}

	protected function getCurrentTest(): string
	{
		return $this->getName();
	}

	/**
	 * @hook http_response 0
	 */
	public function http_response($response, $args, $url) {

		if($this->config['url'] === $url) {
			return $this->config['response'];
		}

		return $this->config['second_response'];
	}
}