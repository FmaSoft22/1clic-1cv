<?php

namespace App\Domains\FmaDomSecurity;


class TokenRequest{

    public $client_id;
    public $client_secret;
    public $grand_type;
    public $userName;
    public $password;
    public $refresh_token;
    public $redirect_uri;
    public $is_relaying_party;
    public $duration;

    public function __constructor(){
        $argsNums = func_num_args();
        $args = func_get_args();
        if(method_exists($this, $func = 'constructor'.$argsNums)){
            call_user_func_array(array($this, $func), $args);
        }
    }

    private function constructor1(){

    }
    private function constructor2(string $client_id,string $grant_type,string $refresh_token, string $redirect_uri,bool $is_relaying_party = false,int $duration = 10){
        $this->client_id = $client_id;
        $this->grand_type = $grant_type;
        $this->refresh_token = $refresh_token;
        $this->redirect_uri = $redirect_uri;
        $this->is_relaying_party = $is_relaying_party;
        $this->duration = $duration;
    }

    public function constructor3(string $client_id,string $grant_type,string $userName,string $password,string $redirect_uri,bool $is_relaying_party = false,int $duration = 10){
        $this->client_id = $client_id;
        $this->userName = $userName;
        $this->password = $password;
        $this->redirect_uri = $redirect_uri;
        $this->is_relaying_party = $is_relaying_party;
        $this->duration = $duration;
    }
}
