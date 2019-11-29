<?php

namespace App\Enterprise\Models\User;

class User
{
    private $id;
    private $name;

    public function __construct(UserId $id, UserName $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}