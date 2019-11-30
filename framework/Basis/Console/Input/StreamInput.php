<?php


namespace Clarc\Basis\Console\Input;


use Clarc\Basis\Console\Input\Question\ChoiceQuestion;
use Clarc\Basis\Console\Input\Question\Question;
use Clarc\Basis\Console\Output\OutputInterface;

class StreamInput implements InputInterface
{
    /**
     * @var resource
     */
    private $inputStream;

    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * StreamInput constructor.
     * @param resource $inputStream
     * @param OutputInterface $output
     */
    public function __construct($inputStream, OutputInterface $output)
    {
        $this->inputStream = $inputStream;
        $this->output = $output;
    }

    public function ask(string $message, $default = null): string
    {
        $question = new Question($message, $default);

        return $this->askQuestion($question);
    }

    public function askQuestion(Question $question): string
    {
        $this->newline();
        $this->output->write(' ');
        $this->prompt($this->output, $question);
        $this->output->write(" > ");

        $inputStream = $this->inputStream ?: STDIN;
        $result = fgets($inputStream);

        if ($question->isTrimmable()) {
            $result = trim($result);
        }

        if (strlen($result) === 0) {
            $result = $question->getDefault();
        }

        $this->newline();

        return $result;
    }

    private function prompt(OutputInterface $output, Question $question)
    {
        if ($question instanceof ChoiceQuestion) {
            $choices = $question->getChoices();
            $maxWidth = max(array_map([$this, 'strlen'], array_keys($choices)));

            $messages = (array)$question->getQuestion();
            foreach ($choices as $key => $value) {
                $width = $maxWidth - $this->strlen($key);
                $messages[] = '  [' . $key.str_repeat(' ', $width) . '] ' . $value;
            }

            $output->write($messages, true);
        } else {
            $message = $question->getQuestion();
            $output->write($message, true);
        }
    }

    private function strlen($string)
    {
        if (false === $encoding = mb_detect_encoding($string, null, true)) {
            return \strlen($string);
        }

        return mb_strwidth($string, $encoding);
    }

    private function newline()
    {
        $this->output->write("\n");
    }
}