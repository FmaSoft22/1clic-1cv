<?php

namespace  App\Domains\FmaDomSecurity\Identity;

class UserInfos
{
    public $ID;
    public $Reference;
    public $Pseudo;
    public $Title;
    public $FirstName;
    public $MiddleName;
    public $LastName;
    public $EmailAdress1;
    public $EmailAdress2;
    public $Phone1;
    public $Phone2;
    public $Fax;
    public $lastActivityDate;
    public $CreationDate;
    public $ModificationDate;
    public $Town;
    public $PostalCode;
    public $CountryCode;
    public $Guid;
    public $Note;
    public $Identifier;
    public $IdentifierType;
    public $PhoneFileName;
    public $Tag1;
    public $Tag2;
    public $Tag3;
    //Membership infos
    public  $IdentifierEmail;
    public  $IdentifierMobilePhone;
    public  $IdentifierIFU;
    public  $PasswordQuestion;
    public  $PasswordAnswer;
    public  $ValidationCode;
    public  $SecurityProvider;
    public  $LastLoginDate;
    public  $LastPasswordChangedDate;
    public  $LastLockoutDate;
    public  $ValidateDate;
    public  $IsApproved;
    public  $IsLockedOut;
    public  $IsValidated;
    public  $Roles = array();
    public  $Properties = array();
}
