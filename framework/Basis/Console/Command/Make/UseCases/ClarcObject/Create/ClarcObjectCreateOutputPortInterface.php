<?php


namespace Clarc\Basis\Console\Command\Make\UseCases\ClarcObject\Create;


interface ClarcObjectCreateOutputPortInterface
{
    function output(ClarcObjectCreateOutputData $outputData);
}