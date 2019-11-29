<?php

namespace App\InterfaceAdapters\Presenters\User\Create;

use App\Application\OutputPorts\User\Create\UserCreateOutputPortInterface;
use App\Application\OutputPorts\User\Create\UserCreateOutputData;

class UserCreatePresenter implements UserCreateOutputPortInterface
{
    public function output(UserCreateOutputData $outputData)
    {
        $viewModel = new UserCreateViewModel($outputData);
        echo view('user/create', compact('viewModel'));
    }
}
