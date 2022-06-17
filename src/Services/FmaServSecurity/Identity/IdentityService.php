<?php

namespace App\Services\FmaServSecurity\Identity;
use App\Domains\FmaDomSecurity\Identity\ConnectedUser;
use App\Domains\FmaDomUtils;
use App\Domains\FmaDomUtilis\CommonClasses;
use Doctrine\Persistence\ManagerRegistry;
use App\Domains\FmaDomSecurity\Identity\BizUserAccount;
use App\Domains\FmaDomSecurity\Identity\UserInfos;
use App\Repositories\FmaRepIdentity\DALContainer;

class IdentityService implements IIdentityService
{
    private static  $_instance;
    private ManagerRegistry $registry;
    private $repository;
    protected function __construct(ManagerRegistry $registry){
        $this->registry = $registry;
        $this->repository = $registry->getManager()->getRepository('App\Entity\Account\Memberships');
    }
    protected function __clone(){}

    public static function getInstance(ManagerRegistry $registry):IIdentityService{
        if(is_null(self::$_instance)){
            self::$_instance = new IdentityService($registry);
        }
        return self::$_instance;
    }

    public function GetSequencesTables(string &$sequenceValue)
    {
        try{
            $container = new DALContainer();
            $container->GetSequencesValue($sequenceValue);
        }catch (Exception $e){
            throw $e;
        }
    }

    public function ValidateAccountUser(string $identifier, bool $isEmail, string $passWord, string &$userGuid): bool
    {
        return true;
    }

    public function GetAccountUserByGuid(string $userGuid):ConnectedUser
    {
        $ConnectUser = new ConnectedUser();
        $ConnectUser->FirstName = 'YESSOUFOU';
        $ConnectUser->LastName = 'MOHAMED';
        $ConnectUser->Title = 'Mr';
        $ConnectUser->Guid ='deb2f984-d552-11ec-b5ed-b82a72c275ef';
        return $ConnectUser;
    }

    public function GetAccountUserGuid(string $identifier, string $identityType)
    {
        $user = null;
        $memberships = $this->repository->find(1);
        return 'deb2f984-d552-11ec-b5ed-b82a72c275ef';
    }

    public function CreateAccountUser(BizUserAccount $userAccount)
    {
        // TODO: Implement CreateAccountUser() method.
    }

    public function UpdateAccountUser(BizUserAccount $userAccount)
    {
        // TODO: Implement UpdateAccountUser() method.
    }

    public function ActiveAccountUser(string $identifier, string $identifierType, bool $activate)
    {
        // TODO: Implement ActiveAccountUser() method.
    }

    public function GetAccountUserByUserID(int $userID)
    {
        // TODO: Implement GetAccountUserByUserID() method.
    }

    public function GetAccountUserByIdentifier(string $identifier, string $identifiertype)
    {
        // TODO: Implement GetAccountUserByIdentifier() method.
    }


    public function GetConnectedUserByGuid(object $userGuid)
    {
        // TODO: Implement GetConnectedUserByGuid() method.
    }

    public function DeleteAccountUser(int $userID)
    {
        // TODO: Implement DeleteAccountUser() method.
    }

    public function HasLocalAccount(string $identifier)
    {
        // TODO: Implement HasLocalAccount() method.
    }

    public function ResetPassword(string $identifier, string $identifierType, string $password)
    {
        // TODO: Implement ResetPassword() method.
    }

    public function SetUserAccountToken(string $identifier, string $identifierType, string $userToken): void
    {
        // TODO: Implement SetUserAccountToken() method.
    }

    public function SetValidationCode(string $identifier, string $identifierType, string $validationCode): void
    {
        // TODO: Implement SetValidationCode() method.
    }

    public function CheckValidationCodee(string $identifier, string $identifierType, string $validationCode): bool
    {
        // TODO: Implement CheckValidationCodee() method.
    }

    public function GetValidationCode(string $identifier, string $identifierType)
    {
        // TODO: Implement GetValidationCode() method.
    }

    public function SetUserRole(string $userGuid, string $userRole, bool $activate)
    {
        // TODO: Implement SetUserRole() method.
    }

    public function GetUserRoles(string $userGuid)
    {
        // TODO: Implement GetUserRoles() method.
    }

    public function SetSecurityProvider(string $identifierEmail, string $securityProvider)
    {
        // TODO: Implement SetSecurityProvider() method.
    }

    public function GetSecurityProvider(string $identifierEmail)
    {
        // TODO: Implement GetSecurityProvider() method.
    }

    public function GetUserInfos(string $identifierEmail): UserInfos
    {
        // TODO: Implement GetUserInfos() method.
    }

    public function GetSponsorShipCode(string $userGuid)
    {
        // TODO: Implement GetSponsorShipCode() method.
    }

    public function CreateSponsorShipCode(string $userGuid, string $sponsorCode, string $metaData)
    {
        // TODO: Implement CreateSponsorShipCode() method.
    }

    public function CheckSponsorShipCode(string $sponsorCode)
    {
        // TODO: Implement CheckSponsorShipCode() method.
    }

    public function GetAccountUserGuidBySponsorshipCode(string $sponsorCode)
    {
        // TODO: Implement GetAccountUserGuidBySponsorshipCode() method.
    }

    public function GetUserAccountIdentifierType(string $identifier){
        $idType='';
        if(CommonClasses::IsEmailIdentifier($identifier))
            $idType = IdentifierType::Email;
        else if(CommonClasses::IsMobilePhoneIdentifier($identifier))
            $idType = IdentifierType::MobilePhone;
        else throw new \Exception('Identiant Utilisateur inconnu');
        return $idType;
    }

    public function CheckIsRegisteredUser(string $identifierEmail)
    {
        // TODO: Implement CheckIsRegisteredUser() method.
    }


}
