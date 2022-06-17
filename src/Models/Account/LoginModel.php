<?php

namespace App\Models\Account;

class LoginModel
{
    public string  $Identifier;
    public string $IdentifierType;
    public string $Password;
    public bool $RememberMe;
}