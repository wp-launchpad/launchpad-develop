<?php
namespace LaunchpadCassette;

use WPLaunchpadPHPUnitWPHooks\MockHooks;

trait CassetteTrait {
    use MockHooks;

	/**
	 * @var Recorder
	 */
	protected $recorder;

	protected function register_cassette() {
		$builder = new RecorderBuilder($this->get_base_directory_cassettes(), static::class);
		$this->recorder = $builder->build("{$this->getName()}");
        $this->mockHooks();
	}

	/**
	 * @hook pre_http_request
	 */
	public function play_request($response, $args, $url) {
		return $this->recorder->play($response, $args, $url);
	}

	/**
	 * @hook http_response
	 */
	public function record_request() {

	}

	abstract public function get_base_directory_cassettes(): string;
}