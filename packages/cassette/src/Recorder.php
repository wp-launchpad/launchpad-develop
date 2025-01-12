<?php

namespace LaunchpadCassette;

class Recorder
{
	/**
	 * @var Request[]
	 */
    protected $requests = [];

	/**
	 * @var Request[]
	 */
	protected $recorded_requests = [];

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

	public function record($response, $args, $url) {

		foreach ($this->recorded_requests as $request) {
			if( $request->applies($url, $args)) {
				$response_entity = new Response();
				if(key_exists('body', $response)) {
					$response_entity->set_body($response['body']);
				}
				$request->add_response($response_entity);
				return;
			}
		}
		$request = new Request();

		$request->set_url($url);

		$request->set_method('GET');

		$response_entity = new Response();
		if(key_exists('body', $response)) {
			$response_entity->set_body($response['body']);
		}

		$this->recorded_requests[] = $request->add_response($response_entity);
	}

	public function dumps(): array {
		return $this->recorded_requests;
	}
}