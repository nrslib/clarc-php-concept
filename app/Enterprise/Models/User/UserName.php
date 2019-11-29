<?php

namespace App\Enterprise\Models\User;

class UserName
{
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }
}