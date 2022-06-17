<?php

namespace  App\Domains\FmaDomSecurity\Identity;

class ConnectedUser
{
    public $ID;
    public $Reference;
    public $Pseudo;
    public $Title;
    public $FirstName;
    public $LastName;
    public $IdentifierEmail;
    public $IdentifierMobilePhone;
    public $IdentifierNoIFU;
    public $Phone;
    public $CountryCode;
    public $PhotoFileName;
    public $ValidationCode;
    public $SecurityProvider;
    public $LastActivityDate;
    public $LastLoginDate;
    public $LastLockoutDate;
    public $ValidateDate;
    public $IsLockedOut;
    public $IsValidated;
    public $IsApprouved;
    public $Guid;
    public $Roles;

    public  function __construct()
    {
        $this->Roles = array();
    }

    public function IsInRole(string $roleName){
        $isInRole = false;
        if(empty($roleName)){
            return $isInRole;
        }
        try{
           if(array_search($roleName,$this->Roles)){
               $isInRole = true;
           }
        }catch (Exception $ex){
            throw $ex;
        }
        return $isInRole;
    }

    public  function IsInRoleList(array $roleNames){
        $isInRole = false;
        $RolesCheckList = [];
        if(count($roleNames) < 0){
            return $isInRole;
        }
        try{
            foreach ($roleNames as $role){
                if($this->IsInRole($role)){
                    $RolesCheckList[$role] = true;
                }else{$RolesCheckList[$role] = false;}
            }
        }catch (Exception $e){
            throw new $e;
        }
    }

    public  function IsInRoleUser(string $roleName , ConnectedUser $user){
        $isInRole = false;
        if(empty($user) || empty($roleName)){
            return $isInRole;
        }
        try{
            if(array_search($roleName,$user->Roles)){
                $isInRole = true;
            }
        }catch (Exception $e){
            throw new $e;
        }
        return $isInRole;
    }
}
