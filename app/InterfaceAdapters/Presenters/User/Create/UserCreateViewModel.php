<?php

namespace App\InterfaceAdapters\Presenters\User\Create;


use App\Application\OutputPorts\User\Create\UserCreateOutputData;

/**
 * Class UserCreateViewModel
 * @package App\Http\ViewModels\User\Create
 */
class UserCreateViewModel
{
    /** @var string */
    private $createdId;

    /**
     * UserCreateViewModel constructor.
     * @param UserCreateOutputData $source
     */
    public function __construct(UserCreateOutputData $source)
    {
        $this->createdId = $source->getCreatedId();
    }

    /**
     * @return string
     */
    public function getCreatedId(): string
    {
        return $this->createdId;
    }
}
