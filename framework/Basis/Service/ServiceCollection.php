<?php

namespace Clarc\Basis\Service;


class ServiceCollection
{
    /**
     * @var ServiceRegisteredConfig[]
     */
    private $registeredConfigs = [];

    public function addTransient(string $interfaze, string $clazz = null)
    {
        if (is_null($clazz)) {
            $clazz = $interfaze;
        }

        $this->registeredConfigs[] = new ServiceRegisteredConfig($interfaze, $clazz, ServiceRegisteredConfig::TYPE_TRANSIENT);
    }

    public function buildServiceProvider ()
    {
        return new ServiceProvider($this->registeredConfigs);
    }
}