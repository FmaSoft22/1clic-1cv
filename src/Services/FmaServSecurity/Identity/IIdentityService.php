<?php

namespace App\Services\FmaServSecurity\Identity;

use App\Domains\FmaDomSecurity\Identity\BizUserAccount;
use App\Domains\FmaDomSecurity\Identity\UserInfos;

interface IIdentityService
{
   public function ValidateAccountUser(string $identifier, bool $isEmail, string $passWord, string  &$userGuid):bool;
   public function GetSequencesTables(string &$sequenceValue);
   public function CreateAccountUser(BizUserAccount $userAccount);
   public function UpdateAccountUser(BizUserAccount $userAccount);
   public function ActiveAccountUser(string $identifier , string $identifierType , bool $activate);
   public function GetAccountUserByUserID(int $userID);
   public function GetAccountUserGuid(string $identifier , string $identityType);
   public function GetAccountUserByIdentifier(string $identifier , string $identifiertype);
   public function GetAccountUserByGuid(string $userGuid);
   public function GetConnectedUserByGuid(object $userGuid);
   public function DeleteAccountUser(int $userID);
   public function HasLocalAccount(string $identifier);
   public function ResetPassword(string $identifier,string $identifierType,string $password);
   public function SetUserAccountToken(string $identifier, string $identifierType , string $userToken):void;
   public function SetValidationCode(string $identifier , string $identifierType , string $validationCode):void;
   public function CheckValidationCodee(string $identifier , string $identifierType , string $validationCode):bool;
   public function GetValidationCode(string $identifier, string $identifierType);
   public function SetUserRole(string $userGuid , string $userRole , bool $activate);
   public function GetUserRoles(string $userGuid);
   public function SetSecurityProvider(string $identifierEmail , string $securityProvider);
   public function GetSecurityProvider(string $identifierEmail);
   public function GetUserInfos(string $identifierEmail):UserInfos;
   public function GetSponsorShipCode(string $userGuid);
   public function CreateSponsorShipCode(string $userGuid, string $sponsorCode , string $metaData);
   public function CheckSponsorShipCode(string $sponsorCode);
   public function GetAccountUserGuidBySponsorshipCode(string $sponsorCode);
   public function CheckIsRegisteredUser(string $identifierEmail);
}
