<?php

namespace LaunchpadBuild\Steps;

use Ahc\Cli\IO\Interactor;

abstract class AbstractStep implements StepInterface
{
    /**
     * @var Interactor
     */
    protected $io;

    public function set_io(Interactor $io): void
    {
        $this->io = $io;
    }

    public function __invoke($payload): array
    {
        $this->io->write($this->get_beginning_message(), true);
        $result = $this->process($payload);
        $this->io->write($this->get_ending_message(), true);
        if(! is_array($result)) {
            return $payload;
        }
        return $result;
    }

    abstract protected function get_beginning_message(): string;
    abstract protected function get_ending_message(): string;

    abstract protected function process($payload);
}