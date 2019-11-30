<?php


namespace Clarc\Basis\Console\Command\Make\UseCases\Dependency\Append;


/**
 * Class ClarcProviderAppendUseCaseInputData
 * @package nrslib\ClarcLaravelPlugin\UseCases\ClarcProvider\AppendUseCase
 */
class DependencyAppendUseCaseInputData
{
    /**
     * @var string
     */
    public $clarcProviderCode;
    /**
     * @var string
     */
    public $clarcDebugProviderCode;
    /**
     * @var string
     */
    public $identifer;
    /**
     * @var string
     */
    public $controllerName;
    /**
     * @var string
     */
    public $inputPortName;
    /**
     * @var string
     */
    public $interactorName;
    /**
     * @var string
     */
    public $outputPortName;
    /**
     * @var string
     */
    public $presenterName;

    /**
     * ClarcProviderAppendUseCaseInputData constructor.
     * @param string $clarcProviderCode
     * @param string $clarcDebugProviderCode
     * @param string $identifer
     * @param string $controllerName
     * @param string $inputPortName
     * @param string $interactorName
     * @param string $outputPortName
     * @param string $presenterName
     */
    public function __construct(
        string $clarcProviderCode,
        string $clarcDebugProviderCode,
        string $identifer,
        string $controllerName,
        string $inputPortName,
        string $interactorName,
        string $outputPortName,
        string $presenterName)
    {
        $this->clarcProviderCode = $clarcProviderCode;
        $this->clarcDebugProviderCode = $clarcDebugProviderCode;
        $this->identifer = $identifer;
        $this->controllerName = $controllerName;
        $this->inputPortName = $inputPortName;
        $this->interactorName = $interactorName;
        $this->outputPortName = $outputPortName;
        $this->presenterName = $presenterName;
    }
}