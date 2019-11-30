<?php


namespace Clarc\Basis\Console\Command\Make\UseCases\Dependency\Append;


interface DependencyAppendUseCaseOutputPortInterface
{
    function output(DependencyAppendUseCaseOutputData $outputData);
}