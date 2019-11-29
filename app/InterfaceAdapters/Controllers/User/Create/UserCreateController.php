<?php


namespace App\InterfaceAdapters\Controllers\User\Create;


use App\Application\InputPorts\User\Create\UserCreateInputData;
use App\Application\InputPorts\User\Create\UserCreateInputPortInterface;

class UserCreateController
{
    private $inputPort;

    public function __construct(UserCreateInputPortInterface $inputPort)
    {
        $this->inputPort = $inputPort;
    }

    public function interact(UserCreateInteractData $data) {
        $inputData = new UserCreateInputData($data->name, $data->roleId);
        $this->inputPort->handle($inputData);
    }
}