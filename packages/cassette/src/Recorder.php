<?php

namespace LaunchpadCassette;

class Recorder
{
    protected $requests;

    public function load(array $requests) {
		$this->requests = $requests;
    }

    public function play($response, $args, $url) {

		foreach ($this->requests as $request) {
			if( $request->applies($url, $args)) {
				return $request->get_response();
			}
		}
		return $response;
    }
}