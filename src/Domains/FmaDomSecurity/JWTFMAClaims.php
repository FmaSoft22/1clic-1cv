<?php

namespace App\Domains\FmaDomSecurity;

class JWTFMAClaims{

    //JWT HEADER
    public $alg; // Message authentification Code algorithm
    public $typ; // Algo Type
    public $iss; //Issuer;
    public $sub; //Subject;
    public $aud; //Audience;
    public $exp; //Expiration Time;
    public $expDate;
    public $nbf; // Not Before;
    public $key; // Unique key to valid token;
    public $iat; //the timestamp of token issuing.
    public $user_Guid;

    public function __construct(){

    }
}
