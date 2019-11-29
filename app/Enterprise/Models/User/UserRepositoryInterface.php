<?php

namespace App\Enterprise\Models\User;

interface UserRepositoryInterface
{
    function find(UserId $id);
    function save(User $user);
}