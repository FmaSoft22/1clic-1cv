<?php

namespace App\Common;

class UserData
{
    public  $ApplicationName;
    public  $Language;
    public  $EncryptedAccountGuid;
    public  $Country;
    public  $Currency;
    public  $BasketRef;
    public  $ConsentRef;
    public  $Token;

    public static function ResetUserData(UserData $data):void
    {
        $data->EncryptedAccountGuid = "";
        $data->Token = null;
    }
}
