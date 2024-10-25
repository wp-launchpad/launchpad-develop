<?php

namespace LaunchpadTakeOff\Services;

use BrianHenryIE\Strauss\Console\Commands\Compose;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Application;
class StraussApplication extends Application
{
    public function __construct() {
        parent::__construct('strauss');
    }

    public function strauss()
    {
        $composeCommand = new Compose();
        $this->add($composeCommand);

        $this->setDefaultCommand('compose');

        $input = new StringInput('');
        $output = new ConsoleOutput();

        $this->doRunCommand($composeCommand, $input, $output);
    }
}