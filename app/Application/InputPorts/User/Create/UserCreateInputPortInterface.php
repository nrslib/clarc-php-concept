<?php

namespace App\Application\InputPorts\User\Create;


/**
 * Interface UserCreateInputPortInterface
 * @package packages\InputPorts\User\Create
*/
interface UserCreateInputPortInterface
{
    /**
     * @param UserCreateInputData $inputData
     */
    function handle(UserCreateInputData $inputData);
}
