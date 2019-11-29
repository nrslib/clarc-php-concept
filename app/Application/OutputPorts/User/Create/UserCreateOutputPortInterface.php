<?php

namespace App\Application\OutputPorts\User\Create;


/**
 * Interface UserCreateOutputPortInterface
 * @package packages\OutputPorts\User\Create
*/
interface UserCreateOutputPortInterface
{
    /**
     * @param UserCreateOutputData $outputData
     */
    function output(UserCreateOutputData $outputData);
}
