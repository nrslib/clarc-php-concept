<?php


namespace Clarc\Basis\Console\Command\Make;


use Clarc\Basis\Console\Command\Make\UseCases\Dependency\Append\DependencyAppendUseCaseOutputData;
use Clarc\Basis\Console\Command\Make\UseCases\Dependency\Append\DependencyAppendUseCaseOutputPortInterface;

class ClarcMakeCommandProviderAppendUseCasePresenter implements DependencyAppendUseCaseOutputPortInterface
{
    function output(DependencyAppendUseCaseOutputData $outputData)
    {
        file_put_contents(ClarcConfig::FILE_CLARC_STARTUP, $outputData->getClarcProviderCode());
    }
}