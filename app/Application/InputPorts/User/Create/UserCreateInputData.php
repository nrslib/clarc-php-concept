<?php

namespace App\Application\InputPorts\User\Create;


/**
 * Class UserCreateInputData
 * @package packages\InputPorts\User\Create
 */
class UserCreateInputData
{
    /** @var string */
    private $name;
    /** @var string */
    private $roleId;

    /**
     * UserCreateInputData constructor.
     * @param string $name
     * @param string $roleId
     */
    public function __construct(string $name, string $roleId)
    {
        $this->name = $name;
        $this->roleId = $roleId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getRoleId(): string
    {
        return $this->roleId;
    }
}
