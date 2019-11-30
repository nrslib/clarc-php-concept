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

    public function interact() {
        // Get request parameter from super globals.
        $inputData = new UserCreateInputData('test-user', 'test-role-id');
        $this->inputPort->handle($inputData);
    }
}