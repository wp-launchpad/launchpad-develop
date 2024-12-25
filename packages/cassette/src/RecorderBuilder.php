<?php

namespace LaunchpadCassette;

use LaunchpadFilesystem\WPFilesystemDirect;

class RecorderBuilder {
	/**
	 * @var WPFilesystemDirect
	 */
	protected $filesystem;

	public function __construct() {
		$this->filesystem = new WPFilesystemDirect();
	}

	public function build(string $path): Recorder {
		$recorder = new Recorder();

        if( ! $this->filesystem->is_file($path)) {
			return $recorder;
		}

		$content = $this->filesystem->get_contents($path);

		if( ! $content ) {
			return $recorder;
		}

		$content = yaml_parse($content);

		if( ! $content || ! key_exists('interactions', $content) || ! is_array($content['interactions']) ) {
			return $recorder;
		}

		$requests = [];

		foreach ($content['interactions'] as $interaction) {
			$registered_request = new Request();
			$registered_response = new Response();
			if( ! key_exists('request', $interaction)) {
				continue;
			}

			if( ! key_exists('response', $interaction)) {
				continue;
			}

			$request = $interaction['request'];
			$response = $interaction['response'];

			if( ! key_exists('uri', $request)) {
				continue;
			}

			if( ! key_exists('method', $request)) {
				continue;
			}

			if( ! key_exists('code', $response)) {
				continue;
			}

			$registered_request->set_url($request['uri']);
			$registered_request->set_method($request['method']);
			$registered_response->set_status($response['code']);

			if( key_exists('headers', $request)) {
				$registered_request->set_headers($request['headers']);
			}

			if( key_exists('headers', $response)) {
				$registered_request->set_headers($response['headers']);
			}

			$requests []= $registered_request->add_response($response);
		}

		$recorder->load($requests);
var_dump($requests);
		return $recorder;
	}
}