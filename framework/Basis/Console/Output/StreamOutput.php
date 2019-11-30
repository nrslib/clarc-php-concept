<?php


namespace Clarc\Basis\Console\Output;


use RuntimeException;


class StreamOutput implements OutputInterface
{
    /**
     * @var resource
     */
    private $stream;

    public function __construct($stream)
    {
        $this->stream = $stream;
    }

    function write($messages, bool $newLine = false)
    {
        if (!is_iterable($messages)) {
            $messages = [$messages];
        }

        foreach ($messages as $message) {
            $this->doWrite($message, $newLine);
        }
    }

    function doWrite($message, bool $newLine = false)
    {
        if ($newLine) {
            $message .= PHP_EOL;
        }

        if (fwrite($this->stream, $message) === false) {
            throw new RuntimeException('Write failed.');
        }

        fflush($this->stream);
    }
}