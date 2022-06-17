<?php

namespace App\Controller;



use App\Controller\BaseController;
use App\Domains\FmaDomSecurity\TokenRequest;
use App\Entity\Account\LoginModel;
use App\Services\FmaServSecurity\JwtAbstractFactory\JsonWebEncryptionFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Services\FmaServSecurity\JwtAbstractFactory\JsonWebLocalyFactory;
use App\Services\FmaServSecurity\JwtAbstractFactory\JWETokenUtils;
use App\Domains\FmaDomSecurity\JWTFMAClaims;
use App\Domains\FmaDomSecurity\JWTHashAlgorithmValues;
use App\Domains\FmaDomUtilis\CommonClasses;
use App\Services\FmaServSecurity\JwtAbstractFactory\JWTokenUtilityJWTLocaly;


class AccountController extends BaseController
{
     public function __construct(AuthenticationUtils $authenticationUtils , ManagerRegistry $registry , RequestStack $request)
     {
         parent::__construct($authenticationUtils, $registry, $request);
     }

     #[Route('/testToken',name: 'app_test_token')]
     public function  testToken(Request $request):Response{
         $requestToken = new TokenRequest();
         $requestToken->password = 'Myes1995@';
         $requestToken->userName = 'myessoufou27@gmail.com';
         $requestToken->grand_type = 'client_credentials';
         $requestToken->duration = 500;
         $requestToken->client_id = $this->EncryptPass;
         $requestToken->redirect_uri = '/security/tokenize/';
         $payload = new JWTFMAClaims();
         $payload->key = $this->EncryptPass;
         $payload->typ = 'JWT';
         $payload->alg = JWTHashAlgorithmValues::HS256;
         $payload->exp = time() + 3600;
         $payload->expDate = (new \DateTime('now'))->add(new \DateInterval('PT500M'));
         $payload->iss ='FMA_SOFT';
         $payload->iat = time();
         $payload->nbf = time();
         $payload->aud = 'BonMarche';
         $payload->sub = CommonClasses::concatString('|','myessoufou27@gmail.com','Myes1995');
         $jweFactory = new JsonWebEncryptionFactory();
         $token = $jweFactory->makeJWT()->Encode($payload,$this->EncryptPass,JWTHashAlgorithmValues::SHA512);

         $tofactory = new JWTokenUtilityJWTLocaly();
         $claims = $tofactory->makeTokenFuncClass()->CheckAccessToken($token,$this->EncryptPass);

         $token = $jweFactory->makeJWT()->Tokenize($requestToken);
         print_r($token);
         exit(0);

     }

    #[Route('/login/{returnUrl}',name:'app_login')]
    public function loginGET(AuthenticationUtils $authenticationUtils, string $returnUrl = ''){

        $ViewBagInit = [];
        $ViewBagInit['Action']='loginGET';
        $ViewBagInit['controller_name']='AccountController';
        $ViewBagInit['errors'] = '';
        $ViewData['Action'] = 'index';
        $ViewData['Controller']='loginController';
         // if ($this->getUser()) {
                //     return $this->redirectToRoute('target_path');
         // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        $ViewBagInit['error'] = $error;
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        if($this->IsValidTokenResponse()){
             if (empty($returnUrl))
                return $this->redirect('UserProfile');
            else
                return $this->redirect($returnUrl);
        }
        $ViewData['Action'] = 'login';
        $ViewData['Controller']='loginController';
        return $this->render('account/login.html.twig', [
            'ViewBagInit' => $ViewBagInit,
            'last_username'=>$lastUsername,
            'ViewData'=>$ViewData,
            'curTempGuid'=>''
        ]);
    }

    #[Route('/loginPOST/{returnUrl}',name:'loginPOST')]
    public function loginPOST(AuthenticationUtils $authenticationUtils , Request $request, string $returnUrl=''){

        $ViewBagInit = [];
        $ViewBagInit['Action']='loginPOST';
        $ViewBagReturnUrl = $returnUrl;
        $ViewBagMessage = "";
        $ViewBagFormAction = "Login";
        $login = $request->get('identify');
        $pass = $request->get('password');
        if($request->getMethod()=='GET')
             return $this->redirect('loginGET');
        try{
             $userInfo = sprintf("Connexion du compte (ID:%s, MP:%s)", $login, $pass);
        }catch(\Exception $e){
            throw $e;
        }
        return new Response('');
    }

     #[Route(path: '/logout', name: 'app_logout')]
    public function logout(Request $request): Response
    {
        $request->getSession()->invalidate();
        return $this->redirect('app_global');
    }
}
