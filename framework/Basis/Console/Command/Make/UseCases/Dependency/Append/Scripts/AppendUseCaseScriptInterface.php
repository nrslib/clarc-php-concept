<?php


namespace Clarc\Basis\Console\Command\Make\UseCases\Dependency\Append\Scripts;


/**
 * Interface AppendUseCaseScriptInterface
 * @package nrslib\ClarcLaravelPlugin\UseCases\ClarcProvider\AppendUseCase\Scripts
 */
interface AppendUseCaseScriptInterface
{
    /**
     * @return string
     */
    function getKey(): string;

    /**
     * @return string[]
     */
    function getScripts(): array;
}