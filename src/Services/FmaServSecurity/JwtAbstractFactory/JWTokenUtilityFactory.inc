<?php

namespace App\Services\FmaServSecurity\JwtAbstractFactory;

use App\Domains\FmaDomSecurity\TokenRequest;
use App\Domains\FmaDomUtils\HTTPStatusCode;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use PHPUnit\Util\Exception;

abstract class JWTokenUtilityFactory
{
    abstract function makeTokenFuncClass();
}

class JWTokenUtilityJWE extends JWTokenUtilityFactory{

        public function makeTokenFuncClass()
        {
            return new JWETokenUtils();
        }
}
class JWTokenUtilityJWTLocaly extends  JWTokenUtilityFactory{

    public function makeTokenFuncClass()
    {
       return new JWTLocaltyUtils();
    }
}
class JWTokenUtilityJWS extends  JWTokenUtilityFactory{

    public function makeTokenFuncClass()
    {
        return new JWSTokenUtis();
    }
}


abstract class CommonFunctions{
    abstract function GetAccessToken(TokenRequest $requestToken);
    abstract function CheckAccessToken(string $access_token,string $client_secret);
}

class FactoryFunctions extends  CommonFunctions{

    function GetAccessToken(TokenRequest $requestToken)
    {
        $tokenResponse = null;
        try{
            $base_Url = $requestToken->redirect_uri;
            $urlController = '/security/tokenize/';
            try{
                $response = Http::post($base_Url,(array)$requestToken)->header('application/json');
                dd($response);
            }catch (\Exception $e){
                throw $e;
            }
            if($HttpResponse->getStatusCode() == HTTPStatusCode::S201){
                throw new Exception("0080.1", "Echec authentification : {0} Login ou Mot de passe incorrect", ".");
            }
            $tokenResponse = \GuzzleHttp\json_decode($HttpResponse);

        }catch (\Exception $e){
            throw $e;
        }
        return $tokenResponse;
    }

    function CheckAccessToken(string $access_token, string $client_secret)
    {
        // TODO: Implement CheckAccessToken() method.
    }
}

class JWSTokenUtis extends FactoryFunctions {

    function CheckAccessToken(string $access_token, string $client_secret)
    {
        // TODO: Implement CheckAccessToken() method.
    }
}

class JWETokenUtils extends FactoryFunctions{

    function CheckAccessToken(string $access_token, string $client_secret)
    {
        try
        {
            $jweFactory = new JsonWebEncryptionFactory();
            $claims =  $token = $jweFactory->makeJWT()->DecodeToObject($access_token, $client_secret);
            return $claims;
        }
        catch (Exception $exception) {throw $exception;}
    }
}
class JWTLocaltyUtils extends FactoryFunctions{

    function CheckAccessToken(string $access_token, string $client_secret)
    {
        try
        {
            $jweFactory = new JsonWebLocalyFactory();
            $claims =  $token = $jweFactory->makeJWT()->DecodeToObject($access_token, $client_secret);
            return $claims;
        }
        catch (Exception $exception) {throw $exception;}
    }
}
