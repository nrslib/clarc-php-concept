<?php

namespace App\Application\OutputPorts\User\Create;


/**
 * Class UserCreateOutputData
 * @package packages\OutputPorts\User\Create
 */
class UserCreateOutputData
{
    /** @var string */
    private $createdId;

    /**
     * UserCreateOutputData constructor.
     * @param string $createdId
     */
    public function __construct(string $createdId)
    {
        $this->createdId = $createdId;
    }

    /**
     * @return string
     */
    public function getCreatedId(): string
    {
        return $this->createdId;
    }
}
