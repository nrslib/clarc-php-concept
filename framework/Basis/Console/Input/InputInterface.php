<?php


namespace Clarc\Basis\Console\Input;


use Clarc\Basis\Console\Input\Question\Question;

interface InputInterface
{
    function ask(string $message): string;
    function askQuestion(Question $question): string;
}