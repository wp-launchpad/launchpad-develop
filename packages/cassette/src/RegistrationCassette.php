<?php

namespace LaunchpadCassette;

use PHPUnit\Runner\AfterTestHook;
use PHPUnit\Runner\BeforeTestHook;
use ReflectionClass;

class RegistrationCassette implements BeforeTestHook, AfterTestHook
{
    /**
     * @var Recorder
     */
    protected $recorder;

    public function executeAfterTest(string $test, float $time): void
    {
        $builder = new RecorderBuilder();
        $filename = $this->get_filename($test);
        $this->recorder = $builder->build($_ENV['launchpad_cassette_base_dir'] . $filename);
        add_filter('pre_http_request', [$this, 'play_requests'], 10, 3);
    }

    public function executeBeforeTest(string $test): void
    {
        remove_filter('pre_http_request', [$this, 'play_requests'], 10);
        $filename = $this->get_filename($test);
    }

    public function play_requests($response, $args, $url)
    {
        return $this->recorder->play($response, $args, $url);
    }

    protected function get_filename(string $test): string
    {
        if( ! preg_match('/(?<class>[^ ]+)( with data set "(?<dataset>[^"]+)")?/', $test, $matches) ) {
            return '';
        }

        $class = $matches['class'];

        $parts = explode('::', $class);

        $class = array_shift($parts);

        $class = new ReflectionClass($class);
        $fullname = $class->getName();

        if(0 !== count($parts)) {
            $method = array_shift($parts);
            $fullname .= '\\' . $method;
        }

        if(isset($matches['dataset'])) {
            $dataset = $matches['dataset'];
            $fullname .= '\\' . $dataset;
        }

        return str_replace('\\', '/', $fullname) . '.yaml';
    }
}