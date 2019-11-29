<?php

namespace App\Application\Interactors\User\Create;


use App\Application\InputPorts\User\Create\UserCreateInputPortInterface;
use App\Application\InputPorts\User\Create\UserCreateInputData;
use App\Application\OutputPorts\User\Create\UserCreateOutputData;
use App\Application\OutputPorts\User\Create\UserCreateOutputPortInterface;

/**
 * Class UserCreateInteractor
 * @package packages\Interactors\User
 */
class UserCreateInteractor implements UserCreateInputPortInterface
{
    /** @var UserCreateOutputPortInterface */
    private $outputPort;

    /**
     * UserCreateInteractor constructor.
     * @param UserCreateOutputPortInterface $outputPort
     */
    public function __construct(UserCreateOutputPortInterface $outputPort)
    {
        $this->outputPort = $outputPort;
    }

    /**
     * @param UserCreateInputData $inputData
     */
    public function handle(UserCreateInputData $inputData)
    {
        $this->outputPort->output(new UserCreateOutputData(uniqid()));
    }
}
