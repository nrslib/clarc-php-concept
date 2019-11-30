<?php


namespace Clarc\Basis\Console\Command\Make\UseCases\Dependency\Append\Scripts;


class UseCaseSettingScript implements AppendUseCaseScriptInterface
{
    private $commentLine;
    private $bindControllerLine;
    private $bindInputPortLine;
    private $bindOutputPortLine;

    /**
     * UseCaseSettingScript constructor.
     * @param $commentLine
     * @param $bindInputPortLine
     * @param $bindOutputPortLine
     */
    public function __construct($commentLine, $bindControllerLine, $bindInputPortLine, $bindOutputPortLine)
    {
        $this->commentLine = $commentLine;
        $this->bindControllerLine = $bindControllerLine;
        $this->bindInputPortLine = $bindInputPortLine;
        $this->bindOutputPortLine = $bindOutputPortLine;
    }

    /**
     * @return string
     */
    function getKey(): string
    {
        if (is_null($this->commentLine)) {
            return '';
        }

        return $this->commentLine;
    }

    /**
     * @return string[]
     */
    function getScripts(): array
    {
        if (is_null($this->commentLine)) {
            return [$this->bindControllerLine, $this->bindInputPortLine, $this->bindOutputPortLine];
        }

        return [$this->commentLine, $this->bindControllerLine, $this->bindInputPortLine, $this->bindOutputPortLine];
    }
}