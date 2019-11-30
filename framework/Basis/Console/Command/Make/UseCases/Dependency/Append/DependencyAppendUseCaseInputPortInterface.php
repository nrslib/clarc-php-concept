<?php


namespace Clarc\Basis\Console\Command\Make\UseCases\Dependency\Append;


interface DependencyAppendUseCaseInputPortInterface
{
    function handle(DependencyAppendUseCaseInputData $inputData);
}