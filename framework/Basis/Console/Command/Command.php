<?php

namespace Clarc\Basis\Console\Command;


use Clarc\Basis\Console\Input\InputInterface;
use Clarc\Basis\Console\Input\Question\ChoiceQuestion;
use Clarc\Basis\Console\Output\OutputInterface;

abstract class Command
{
    public abstract function handle();

    protected $signature = '';

    private $input;
    private $output;

    public function __construct(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;
    }

    public function title(string $text)
    {
        $this->info('Welcome to Clarc');
        $this->separator();
        $this->info($text);
        $this->separator();
    }

    public function choice($question, array $choices, string $default = null)
    {
        $question = new ChoiceQuestion($question, $choices, $default);
        return $this->input->askQuestion($question);
    }

    public function need(string $text)
    {
        while (true) {
            $result = $this->ask($text);
            if (!empty($result)) {
                return $result;
            }
        }
    }

    public function separator()
    {
        $this->line('---------------------------------------------------------------');
    }

    public function newline()
    {
        $this->line('');
    }

    public function ask($message): string
    {
        return $this->input->ask($message);
    }

    public function info($message) {
        $this->line($message);
    }

    protected function line($message) {
        $this->output->write($message, true);
    }
}