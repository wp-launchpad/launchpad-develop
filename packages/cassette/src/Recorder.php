<?php

namespace LaunchpadCassette;

class Recorder
{
    protected $recording_dir;

    protected $requests;

    /**
     * @param $recording_dir
     */
    public function __construct($recording_dir)
    {
        $this->recording_dir = $recording_dir;
    }

    protected function load() {

    }

    public function play($response, $args, $url) {

    }
}