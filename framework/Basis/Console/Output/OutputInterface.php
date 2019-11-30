<?php

namespace Clarc\Basis\Console\Output;


interface OutputInterface
{
    /**
     * @param string|iterable $message
     * @param bool $newLine
     * @return mixed
     */
    function write($message, bool $newLine = false);
}