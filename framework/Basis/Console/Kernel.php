<?php


namespace Clarc\Basis\Console;


use Clarc\Basis\Console\Command\Make\ClarcMakeCommand;
use Clarc\Basis\Console\Input\StreamInput;
use Clarc\Basis\Console\Output\StreamOutput;

class Kernel
{
    private $makeCommand;

    public function __construct()
    {
        $output = new StreamOutput(fopen('php://stdout', 'w'));
        $input = new StreamInput(STDIN, $output);
        $this->makeCommand = new ClarcMakeCommand($input, $output);
    }

    public function handle()
    {
        $this->makeCommand->handle();
    }
}