<?php


namespace Clarc\Basis\Service;


use ReflectionClass;
use ReflectionParameter;

class ServiceProvider
{
    /**
     * @var ServiceRegisteredConfig[]
     */
    private $registeredConfigs = [];
    private $instances = [];

    public function __construct(array $registeredConfigs)
    {
        $this->registeredConfigs = $registeredConfigs;
    }

    public function resolve(string $name)
    {
        $instance = $this->instantiate($name);
        return $instance;
    }

    /**
     * @param string $name
     * @return mixed
     * @throws DependencyResolveFailedException
     * @throws \ReflectionException
     */
    private function instantiate(string $name)
    {
        $config = $this->findConfig($name);
        return $this->build($config->getClass());
    }

    /**
     * @param string $classsName
     * @return mixed
     * @throws DependencyResolveFailedException
     * @throws \ReflectionException
     */
    private function build(string $classsName) {
        try {
            $clazz = new ReflectionClass($classsName);
        } catch (\ReflectionException $e) {
            throw new DependencyResolveFailedException("Target class {$classsName} does not exist.");
        }

        if (!$clazz->isInstantiable()) {
            throw new DependencyResolveFailedException("Target class {$classsName} does not instantiable.");
        }

        $constructor = $clazz->getConstructor();
        if (is_null($constructor)) {
            return new $classsName;
        }

        $dependencies = $constructor->getParameters();
        $parameters = $this->resolveDependencies($dependencies);

        return $clazz->newInstanceArgs($parameters);
    }

    private function findConfig(string $interfaze): ServiceRegisteredConfig
    {
        foreach ($this->registeredConfigs as $config) {
            if ($config->matchInterfaze($interfaze)) {
                return $config;
            }
        }
    }

    /**
     * @param ReflectionParameter[] $dependencies
     * @return array
     * @throws DependencyResolveFailedException
     * @throws \ReflectionException
     */
    private function resolveDependencies(array $dependencies)
    {
        $results = [];

        foreach ($dependencies as $dependency) {
            $results[] = is_null($dependency->getClass()) ? $this->resolvePrimitive($dependency) : $this->resolveClass($dependency);
        }

        return $results;
    }

    /**
     * @param ReflectionParameter $parameter
     * @return mixed
     * @throws \ReflectionException
     * @throws DependencyResolveFailedException
     */
    private function resolvePrimitive(ReflectionParameter $parameter) {
        if ($parameter->isDefaultValueAvailable()) {
            return $parameter->getDefaultValue();
        }

        throw new DependencyResolveFailedException("{$parameter} resolve failed.({$parameter->getDeclaringClass()->getName()}");
    }

    /**
     * @param ReflectionParameter $parameter
     * @return mixed
     * @throws DependencyResolveFailedException
     * @throws \ReflectionException
     */
    private function resolveClass(ReflectionParameter $parameter)
    {
        try {
            $instance = $this->resolve($parameter->getClass()->name);
            return $instance;
        } catch (DependencyResolveFailedException $e) {
            if ($parameter->isOptional()) {
                return $parameter->getDefaultValue();
            }

            throw $e;
        }
    }
}