<?php

namespace LaunchpadCassette;

use LaunchpadFilesystem\WPFilesystemDirect;
use ReflectionClass;

class RecorderBuilder {
	/**
	 * @var WPFilesystemDirect
	 */
	protected $filesystem;

    protected $base_dir;

    protected $classname;

	public function __construct(string $base_dir, string $classname) {
		$this->filesystem = new WPFilesystemDirect();
	    $this->base_dir = $base_dir;
        $this->classname = $classname;
    }

	public function build(string $test): Recorder {
		$recorder = new Recorder();

        $filename = $this->get_filename($test);

        if( ! $this->filesystem->is_file($filename)) {
            return $recorder;
		}

		$content = $this->filesystem->get_contents($filename);

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

            if( key_exists('body', $response) && key_exists('string', $response['body'])) {
                $registered_response->set_body($response['body']['string']);
            }

			$requests []= $registered_request->add_response($registered_response);
		}

		$recorder->load($requests);

		return $recorder;
	}

    protected function get_filename(string $test): string
    {
        if( ! preg_match('/(?<class>[^ ]+)( with data set "(?<dataset>[^"]+)")?/', $test, $matches) ) {
            return '';
        }

        $method = $matches['class'];

        $class = new ReflectionClass($this->classname);
        $fullname = $class->getName();

        $fullname .= '\\' . $method;

        if(isset($matches['dataset'])) {
            $dataset = $matches['dataset'];
            $fullname .= '\\' . $dataset;
        }

        return $this->base_dir . str_replace('\\', '/', $fullname) . '.yaml';
    }
}