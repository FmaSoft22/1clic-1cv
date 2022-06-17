<?php
namespace App\Services\FmaServSecurity;

include_once(__DIR__.'/JwtAbstractFactory/AbstractFactoryJWT.inc');

use App\Domains\FmaDomSecurity\JWTFMAClaims;
use App\Domains\FmaDomSecurity\TokenRequest;
use App\Services\FmaServSecurity\JwtAbstractFactory\JsonWebEncryptionFactory;
use App\Services\FmaServSecurity\JwtAbstractFactory\JsonWebLocalyFactory;
use App\Services\FmaServSecurity\JwtAbstractFactory\JsonWebSignatureFacotory;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Domains\FmaDomUtilis\CommonClasses;
use App\Domains\FmaDomUtils\HTTPStatusCode;
use App\Services\FmaServSecurity\JsonWebToken;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Symfony\Contracts\HttpClient\ResponseStreamInterface;

/**
 * @method  withOptions(array $options)
 */
class HttpClient implements HttpClientInterface{

    public function request(string $method, string $url, array $options = []): ResponseInterface
    {
        // TODO: Implement request() method.
    }

    public function stream($responses, float $timeout = null): ResponseStreamInterface
    {
        // TODO: Implement stream() method.
    }

    public function __call(string $name, array $arguments)
    {
        // TODO: Implement @method  withOptions(array $options)
    }
}

class JWTokenUtility
{

    public static function GetAccessToken(TokenRequest $requestToken , string $JWTIssuer){
        $tokenResponse = null;
        try{
            $base_Url = $requestToken->redirect_uri;
            $urlController = 'api/security/tokenize/';
            $HttpClient = new Client();
            try{
                $HttpResponse = $HttpClient->request('POST',$urlController,[
                    'body'=>1
                ]);
                dd($HttpResponse);
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

    public static function GetJWTSupplierServiceType(string $jwtSupplierType):object{
        if(empty($jwtSupplierType))
            throw new \Exception('Le type de fournisseur de service JWT est obligatoire.');

        switch ($jwtSupplierType){
            case 'JWE':
                $jwe = new JsonWebEncryptionFactory();
                return $jwe->makeJWT();
                break;
            case 'JWS':
                $jws = new JsonWebSignatureFacotory();
                return $jws->makeJWT();
                break;
            case 'JWTLocaly':
                $jwtl = new JsonWebLocalyFactory();
                return $jwtl->makeJWT();
                break;
            default:
                throw new \Exception('Le type de fournisseur de service JWT est incconnu');
        }
    }

    public static function CheckAccessToken(string $access_token,string $client_secret,string $JWTSupplierType):object{
        try
        {
             $jSupplierT  = self::GetJWTSupplierServiceType($JWTSupplierType);
             if(is_null($jSupplierT))
                 throw  new \Exception('Le fournisseur de Service JWT est inconnu');
             $claims = $jSupplierT->DecodeToObject($access_token, $client_secret);
             return $claims;
        }
        catch (Exception $exception) {throw $exception;}
    }
}

