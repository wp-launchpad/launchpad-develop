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

    protected function unregister_cassette() {
		$requests = $this->recorder->dumps();
		$builder = new RecorderBuilder($this->get_base_directory_cassettes(), static::class);
		$builder->save("{$this->getName()}", $requests);
        $this->recorder = null;
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
	public function record_request($response, $parsed_args, $url ) {
		$this->recorder->record($response, $parsed_args, $url );
		return $response;
	}

	abstract public function get_base_directory_cassettes(): string;
}