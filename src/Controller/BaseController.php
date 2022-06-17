<?php

namespace App\Controller;

include_once(dirname(__FIlE__,2).'/Services/FmaServSecurity/JwtAbstractFactory/AbstractFactoryJWT.inc');
include_once(dirname(__FIlE__,2).'/Services/FmaServSecurity/JwtAbstractFactory/JWTokenUtilityFactory.inc');


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;

use Symfony\Component\HttpFoundation\Request;
use App\Services\FmaServProcessing\ProcessExecution;
use App\Common\UserData;
use App\Domains\FmaDomSecurity\Encryption;
use App\Domains\FmaDomSecurity\Identity\ConnectedUser;
use App\Domains\FmaDomSecurity\JWTFMAClaims;
use App\Domains\FmaDomSecurity\TokenRequest;
use App\Domains\FmaDomUtilis\CommonClasses;
use App\Services\FmaServSecurity\JWTokenUtility;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Doctrine\Persistence\ManagerRegistry;
use function Symfony\Component\DependencyInjection\Loader\Configurator\env;

class BaseController extends AbstractController
{
    public object $ServiceProcessManager;
    public object|null $ConnectedUserData = null;
    public UserData|null $UserData;
    public string  $UserCookieName ='FMASOFT_COOKIES';
    public bool $IsPageConsent;
    public bool $OnMaintenance;

    public static object|null $instance;
    public string  $EncryptPass = 'fmaSoFTpasSwoRD';
    public static bool $IsAuthentificated;

    public  ManagerRegistry $doctrineRegistry;
    protected AuthenticationUtils $authenticationUtils;
    protected RequestStack $request;

    const CAND_GUID = '7b898909-e04d-11ec-bc3d-b82a72c275ef';

    public static function getInstance(): object
    {
        return self::$instance;
    }

    public function getRegistry(){
        return $this->doctrineRegistry;
    }

    public function setInstance($instance){
        throw new \Exception('UnAuthorized modifiy property');
    }
    public function getIsAuthentificated():bool{
        return self::$IsAuthentificated;
    }
    public function setIsAuthentificated(bool $isAuthent){
        throw new \Exception('UnAuthorized modifiy property');
    }


    public function __construct(AuthenticationUtils $authenticationUtils , ManagerRegistry $registry,RequestStack $requestStack){
        $this->ServiceProcessManager = ProcessExecution::getInstance(null,$registry)->ServiceManager();
        self::$instance = $this;
        $this->authenticationUtils = $authenticationUtils;
        $this->request = $requestStack;
        $this->doctrineRegistry = $registry;
        $this->UserData  = new UserData();
        $this->Initialize();
    }



    protected function Initialize(){
        $genericViews = ['error','general-terms','legal-mention','cookies-notice',
            'privacy-notice','terms-of-use','help','broadcast-rules','howitworks','categories','aboutus','apps'];
        $currentAction = explode('/',$this->request->getCurrentRequest()->getPathInfo())[1];

        $this->GetFmaIdentity();
    }

     public function GetFmaIdentity():void{
            $ConnectedUserData = null;
            $IsUserAuthenticated = false;
            $UserCookieData = $this->GetUserCookieData();
            $ApplicationName = 'FMA-SOFT';
            try{
                if(empty($UserCookieData)){
                    $this->SignOutFormAuth();
                    return;
                }
                if($this->IsValidTokenResponse())
                {
                    $client_secret = CommonClasses::$EncryptPass;
                    $claims = JWTokenUtility::CheckAccessToken($UserCookieData->Token->access_token,$client_secret,'JWE');
                    if(!empty($claims) && !empty($claims->user_guid)){
                        $IsUserAuthenticated = true;
                        return;
                    }
                }
                if($UserCookieData->Token != null && !$this->IsValidTokenResponse())
                {
                    $this->SignOutFormAuth();
                }
            }catch (\Exception $e){
                $this->SignOutFormAuth();
        }
    }

    public function ConnectedUserIsAuthorize(ConnectedUser $user):bool{
            if(!empty($user) && !$user->IsLockedOut && $user->IsValidated && $user->IsApprouved)
                return true;
            return false;
        }

    protected function SetUserProfileData(string $user_guid):void{
            if(empty($user_guid))
                return;
            $connectedUser = $this->ServiceProcessManager->IDService()->GetAccountUserByGuid($user_guid);
            if(!empty($connectedUser) && isset($connectedUser->IsApproved) &&  isset($connectedUser->IsLockedOut) && isset($connectedUser->IsValidated)
            && !$connectedUser->IsLockedOut && $connectedUser->IsValidated && $connectedUser->IsApproved){
                $userD = new UserData();
                $userD->EncryptedAccountGuid = $user_guid;
                $userD->Country = $connectedUser->CountryCode;
                $this->UserData = $userD;
            }else
                UserData::ResetUserData($this->UserData);
    }

     public function IsValidTokenResponse():bool{
            $isValid = false;
            $tokenRequest = null;
            $tokenRequest = $this->GetValidTokenResponse();
            if(!empty($tokenRequest))
                $isValid = true;
            return $isValid;
    }

    public function GetValidTokenResponse():mixed{
            $tokenResponse = null;
            $userData = $this->GetUserCookieData();
            if(empty($userData) || $userData->Token == null)
                return null;
            if(!$this->getIsAuthentificated()){
                return null;
            }
            $requestToken = null;
            try{
                $tokenResponse = JWTokenUtility::CheckAccessToken($userData->Token->access_token,CommonClasses::$EncryptPass,'JWE');
            }catch (\Exception $e){
                if($e->getCode()==='0081.4'){
                    $requestToken  = new TokenRequest();
                    $requestToken->client_secret = env('APP_NAME');
                    $requestToken->grand_type="refresh_token";
                    $requestToken->userName = null;
                    $requestToken->password = null;
                    $requestToken->redirect_uri = Request::path();
                    $tokenResponse = JWTokenUtility::GetAccessToken($requestToken,'JWE');
                }
            }
            return $tokenResponse;
    }

    public function GetUserCookieData(){
            $cookieValue = null;
            $userData = null;
            if($cookieValue == null){
                $userData = new UserData();
                $userData->ApplicationName = 'FMA_SOFT';
            }else{
                $strDecUsrData = $cookieValue;
                $userData = (object)json_decode($strDecUsrData);
            }
            return $userData;
    }

    public function SetUserCookieData(UserData $userData){
            $cookieValue = (object)Cookie::get($this->UserCookieName);
            if(empty($cookieValue->Currency)){
                $cookieValue->Currency = 'fr-FR';
            }
            $strUserData = json_encode($userData);
            dd($strUserData);
            date_default_timezone_set('UTC');
            if($cookieValue == null){
                \setcookie($this->UserCookieName,$strUserData,((new \DateTime('now'))->add(new \DateInterval('P3M')))->getTimestamp(),'','',true);
            }
            else{
                \setcookie($this->UserCookieName,$strUserData,((new \DateTime('now'))->add(new \DateInterval('P3M')))->getTimestamp(),'','',true);
            }
    }

    protected function SignIn(TokenRequest  $tokenRequest):?JWTFMAClaims{
        if(empty($tokenRequest))
            return null;
        return new JWTFMAClaims();
    }

    protected function SignInFormAuth(string $identify,bool $remember){

    }

     protected function SignOutFormAuth(){
            UserData::ResetUserData($this->UserData);
            $this->SetUserCookieData($this->UserData);
            $this->request->getSession()->invalidate();
    }

    public function IsMobileDevice():string{
        $request = $this->request->getCurrentRequest();
        return $request->headers['HTTP_USER_AGENT'];
    }
}
