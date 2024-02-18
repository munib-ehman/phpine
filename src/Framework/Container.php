<?php

declare(strict_types=1);

namespace Framework;

use ReflectionClass, ReflectionNamedType;
use Framework\Exceptions\ContainerException;

class Container
{

    private array $definations = [];

    public function addDefinations(array $newDefination)
    {
        $this->definations = [...$this->definations, ...$newDefination];
    }

    public function resolve(string $className)
    {
        $reflectionClass =  new ReflectionClass($className);
        if (!$reflectionClass->isInstantiable()) {
            throw new ContainerException("Class {$className} is not instanciable");
        }

        $constructor = $reflectionClass->getConstructor();

        if (!$constructor) {
            return new $className;
        }
        $params = $constructor->getParameters();

        if (count($params) == 0) {
            return new $className;
        }
        $dependencies = [];

        foreach ($params as $param) {
            $name = $param->getName();
            $type = $param->getType();
            if (!$type) {
                throw new ContainerException("Failed to resolve class {$className} because param {$name} is missing type hint.");
            }

            if (!$type instanceof ReflectionNamedType || $type->isBuiltin()) {
                throw new ContainerException("Failed to resolve class {$className} because of invalid param {$name} type");
            }

            $dependencies[] = $this->get($type->getName());
        }


        return $reflectionClass->newInstanceArgs($dependencies);
    }

    public function get(string $id)
    {
        if (!array_key_exists($id, $this->definations)) {
            throw new ContainerException("Class {$id} not exist in our container");
        }

        $factory = $this->definations[$id];
        $dependency =  $factory();

        return $dependency;
    }
}
