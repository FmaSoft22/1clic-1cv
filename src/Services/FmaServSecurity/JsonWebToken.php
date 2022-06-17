<?php

namespace App\Services\FmaServSecurity;
use App\Domains\FmaDomSecurity\JWTFMAClaims;
use App\Domains\FmaDomSecurity\JWTHashAlgorithmValues;
use App\Domains\FmaDomSecurity\TokenRequest;
use App\Domains\FmaDomSecurity\TokenResponse;
use App\Domains\FmaDomUtilis\CommonClasses;
use App\Domains\FmaDomUtils;
use App\Domains\FmaDomSecurity\Identity\ConnectedUser;
use Jose\Component\Core\AlgorithmManager;
use Jose\Component\KeyManagement\JWKFactory;
use Jose\Component\Signature\Algorithm\HS256;
use Jose\Component\Signature\Algorithm\HS384;
use Jose\Component\Signature\Algorithm\HS512;
use Jose\Component\Signature\JWS;
use App\Services\FmaServSecurity\Identity\IdentityService;
use Jose\Component\Signature\JWSVerifier;
use Jose\Component\Signature\Serializer\CompactSerializer;
use Jose\Component\Signature\Serializer\JWSSerializerManager;
use App\Services\FmaServSecurity\Identity\IIdentityService;


class JsonWebToken{

    private static $algorithm_manager;
    public static $SecurityServiceManager;

    public function __construct(){
        self::$algorithm_manager = new AlgorithmManager(new HS256());
    }

    public static function initSecurityServiceManager(){
        $IIdentityServ = IdentityService::getInstance();
        self::$SecurityServiceManager = $IIdentityServ;
    }

    // FMA-SOFT YESSOUFOU MOHAMED-Genère un Token d'authentification(JWT)
    public static function Tokenize(TokenRequest $tokenRequest){
        self::initSecurityServiceManager();
        if(empty($tokenRequest) || empty($tokenRequest->grand_type) || empty($tokenRequest->client_id))
            return null;
        $client_secret ='';
        try{
            $client_secret = CommonClasses::$EncryptPass;
            if(empty($client_secret))
                return null;
        }catch (\Exception $e){throw $e;}
        $ConnUser = new ConnectedUser();
        if(strtolower($tokenRequest->grand_type) == 'client_credentials'){
            $userGuid = '';
            if(!$tokenRequest->is_relaying_party && !self::$SecurityServiceManager->ValidateAccountUser($tokenRequest->userName,
               true,$tokenRequest->password,$userGuid))
                return null;
            $userGuid = strval($userGuid);
            $userAccGuid = self::$SecurityServiceManager->GetAccountUserGuid($tokenRequest->userName,"Email");
            $connectedUser = self::$SecurityServiceManager->GetAccountUserByGuid(strval($userAccGuid));

            if(is_null($connectedUser))
                return null;
            $ConnUser = $connectedUser;
        }else if(strtolower($tokenRequest->grand_type)=='refresh_token'){
            $claims = (object)DecodeToObject($tokenRequest->refresh_token, $tokenRequest->client_secret);
            $connectedUser = self::$SecurityServiceManager->GetAccountUserByGuid($claims->user_Guid);

            if(is_null($claims) || $connectedUser == null)
                return null;
            $ConnUser = $connectedUser;
        }

        date_default_timezone_set('UTC');
        $dateFinToken = new \DateTime('now');
        try{
            $dateFinToken = $dateFinToken->add(new \DateInterval('PT'.$tokenRequest->duration.'M'));
        }catch (\Exception $e){throw  $e;}
        $jwtClaim = new JWTFMAClaims();
        $tokenResp= new TokenResponse();
        $jwtClaim->alg ='HS256';
        $jwtClaim->typ ='JWT';

        $jwtClaim->iss = "https://identity.fmaSoft.com/security/tokenize";
        $jwtClaim->sub = "FMA Identity authentication/authorization";
        $jwtClaim->aud = "FMA Identity Web Sites";


        $jwtClaim->exp = strval(round($dateFinToken->getTimestamp() - (new \DateTime('now'))->getTimestamp()));
        //$jwtClaim->nbf = strval(round((new \DateTime('now'))->getTimestamp() - ))
        //$jwtClaim->iat = "";
        //$jwtClaim->jti = "";
        //$jwtClaim->given_name = user.FirstName;
        //$jwtClaim->family_name = user.LastName;
        //$jwtClaim->nickname = user.Pseudo;
        //$jwtClaim->gender = user.Title;
        //$jwtClaim->roles = (user.Roles != null ? string.Join("|", user.Roles) : "");
        //$jwtClaim->services = (user.Services != null ? string.Join("|", user.Services) : "");
        $jwtClaim->user_Guid = strval($ConnUser->Guid);
        $jwtClaim->expDate = $dateFinToken;

        //Access_token
        $tokenResp->access_token = self::Encode( $jwtClaim, $client_secret, JWTHashAlgorithmValues::HS256);

        //Refresh token
        $jwtClaim->exp = strval(round((new \DateTime('now'))->add(new \DateInterval('P15D'))->getTimestamp() -(new \DateTime('now'))->getTimestamp()));
        $tokenResp->refresh_token = self::Encode($jwtClaim, $client_secret, JWTHashAlgorithmValues::HS256);
        $tokenResp->expires_in = $jwtClaim->exp;
        $tokenResp->expiration = $dateFinToken;
        $tokenResp->token_type = "bearer";

        return $tokenResp;

    }


    public static function Detokenize(string $JWebToken, string $client_secret)
    {
        $tokenResp = (object)json_decode($JWebToken);
        $claims =json_decode(self::Decode($tokenResp->access_token,$client_secret,JWTHashAlgorithmValues::HS256,true));
        if($claims != null)
            return $claims->user_Guid;
        else return null;
    }

    public static function Encode(JWTFMAClaims $payload, string $key , string $algorithm){
        $jwk = JWKFactory::createFromSecret(CommonClasses::stringToBinary(base64_encode($key)),['alg'=>$algorithm,
        'typ'=>'JWT']);
        self::BuildAlgoManager($algorithm);
        $jwsBuilder = new \Jose\Component\Signature\JWSBuilder(self::$algorithm_manager);
        $payloadInfos =  json_encode($payload);
        $jws = $jwsBuilder->create()->withPayload($payloadInfos)->addSignature($jwk,['alg'=>$algorithm])->build();
        $serializer = new CompactSerializer();
        $token = $serializer->serialize($jws,0);
        return $token;
    }

    public static function Decode(string $token,string $key , string $algorithm, bool $verify = true){
        $parts = explode('.',$token);
        if(count($parts) < 3)
            throw new \Exception("0081.1", "Token must consist from 3 delimited by dot parts");
        self::BuildAlgoManager($algorithm);
        $jwsVerifier = new JWSVerifier(self::$algorithm_manager);

        $jwk = JWKFactory::createFromSecret(CommonClasses::stringToBinary(base64_encode($key)),['alg'=>$algorithm,
            'typ'=>'JWT']);

        $serializerManager = new JWSSerializerManager([
            new CompactSerializer(),
        ]);

        $jws = $serializerManager->unserialize($token);
        $payloadJson = $jws->getPayload();
        if($verify){
            $verify = self::VerifyToken($token,$key,$algorithm);
            if(!$verify)
                throw new OBAException("0081.2", "Invalid signature token");
            $payloadData = (object)json_decode($payloadJson);

            if(!empty($payloadData->exp) && !is_null($payloadData)){
                $exp = 0;
                try{$exp = intval($payloadData->exp);}catch (\Exception $ex){
                    throw new \Exception("0081.3", "Claim 'exp' must be an integer.".$ex);
                }
                date_default_timezone_set('UTC');
                $secondsSinceEpoch = strval(round((new \DateTime('now'))->getTimestamp()));
                $dateCompare = date_create($payloadData->expDate->date)->getTimestamp();
                if((intval($dateCompare) - intval($secondsSinceEpoch)) <= 0 ){
                    throw new \Exception("Token has expired", 0081.4);
                }
            }
        }
        return $payloadJson;
    }

    public static function DecodeToObject(string $token, string $key, bool $verify = true): object
    {
        $payloadJson = self::Decode($token, $key,JWTHashAlgorithmValues::HS256, $verify);
        $payloadData = (object)json_decode($payloadJson);
        if($payloadData == null)
            throw new \Exception('Claims inconnu');
        return $payloadData;
    }

    private static function GetHashAlgorithm(string $algorithm)
    {
        switch ($algorithm)
        {
            case "HS256": return JWTHashAlgorithmValues::HS256;
            case "HS384": return JWTHashAlgorithmValues::HS384;
            case "HS512": return JWTHashAlgorithmValues::HS512;
            default: throw new \Exception("0082.1", "Algorithm not supported.");
        }
        return null;
    }



    public static function VerifyToken(string $token , string $key,string $algorithm):bool{
        $parts = explode('.',$token);
        if(count($parts) < 3)
            throw new \Exception("0081.1", "Token must consist from 3 delimited by dot parts");
        self::BuildAlgoManager($algorithm);
        $jwsVerifier = new JWSVerifier(self::$algorithm_manager);
        $jwk = JWKFactory::createFromSecret(CommonClasses::stringToBinary(base64_encode($key)),['alg'=>$algorithm,
            'typ'=>'JWT']);
        $serializerManager = new JWSSerializerManager([
            new CompactSerializer(),
        ]);
        $jws = $serializerManager->unserialize($token);
        $isVerified = $jwsVerifier->verifyWithKey($jws, $jwk, 0);
        return $isVerified;
    }

    public static function BuildAlgoManager(string $algorithm){
        switch ($algorithm){
            case JWTHashAlgorithmValues::HS256:
                self::$algorithm_manager = new AlgorithmManager([new HS256()]);
                break;
            case JWTHashAlgorithmValues::HS384:
                self::$algorithm_manager = new AlgorithmManager([new HS384()]);
                break;
            case JWTHashAlgorithmValues::HS512:
                self::$algorithm_manager = new AlgorithmManager([new HS512()]);
                break;
            default:
                throw new Exception("0082.1", "Algorithm not supported.");
        }
    }
}
