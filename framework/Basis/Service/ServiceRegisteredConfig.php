<?php


namespace Clarc\Basis\Service;


/**
 * Class ServiceRegisteredConfig
 * @package Clarc\Basis\Service
 */
class ServiceRegisteredConfig
{
    public const TYPE_TRANSIENT = 1;

    /**
     * @var
     */
    private $interface;
    /**
     * @var string
     */
    private $class;

    /**
     * @var int TYPE
     */
    private $type;

    /**
     * ServiceRegisteredConfig constructor.
     * @param string|null $interfaze
     * @param string $class
     * @param int $type
     */
    public function __construct(string $interfaze, ?string $class, int $type)
    {
        $this->interface = $interfaze;
        $this->class = $class;
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    public function matchInterfaze($interfaze): bool
    {
        return $this->interface === $interfaze;
    }
}