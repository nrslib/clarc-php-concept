<?php

namespace App\Enterprise\Models\User;

class UserId
{
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }
}