<?php


namespace Clarc\Basis\Console\Command\Make\UseCases\ClarcObject\Create;


interface ClarcObjectCreateInputPort
{
    function handle(ClarcObjectCreateInputData $inputData);
}