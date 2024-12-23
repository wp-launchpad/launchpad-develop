<?php

trait CassetteTrait {
    use \WPLaunchpadPHPUnitWPHooks\MockHooks;

	/**
	 * @hook pre_http_request
	 */
	public function play_request($response, $args, $url) {

        return $response;
	}

	/**
	 * @hook http_response
	 */
	public function record_request() {

	}

	abstract public function get_base_directory_cassettes(): string;
}