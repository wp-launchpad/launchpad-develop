<?php

trait CassetteTrait {

	/**
	 * @hook pre_http_request
	 */
	public function play_request() {

	}

	/**
	 * @hook http_response
	 */
	public function record_request() {

	}

	abstract public function get_base_directory_cassettes(): string;
}