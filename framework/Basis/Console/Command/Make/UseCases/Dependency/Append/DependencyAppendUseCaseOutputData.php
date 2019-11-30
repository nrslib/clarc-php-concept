<?php


namespace Clarc\Basis\Console\Command\Make\UseCases\Dependency\Append;


class DependencyAppendUseCaseOutputData
{
    /**
     * @var string
     */
    private $clarcProviderCode;

    /**
     * ClarcProviderAppendUseCaseOutputData constructor.
     * @param string $clarcProviderCode
     */
    public function __construct($clarcProviderCode)
    {
        $this->clarcProviderCode = $clarcProviderCode;
    }

    /**
     * @return mixed
     */
    public function getClarcProviderCode()
    {
        return $this->clarcProviderCode;
    }
}