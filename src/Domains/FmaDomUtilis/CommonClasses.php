<?php

namespace App\Domains\FmaDomUtilis;
use Symfony\Component\String\UnicodeString;
class CommonClasses
{
        public static  $EncryptPass = "oBaTrAdEpAsSwOrD";

        public static function IsEmailIdentifier(string $identifier):bool
        {
            $resBool = preg_match(Emailing::EmailAddressFormat,$identifier);
            return $resBool;
        }
        public static function IsMobilePhoneIdentifier(string $identifier):bool
        {
            $resBool = preg_match(Emailing::SMSNumberFormat,$identifier);
            return $resBool;
        }

    public static function ConstructProcV1(string $procName,int $numArgs = 0, array $args):string{
        if(empty($procName)){
            throw new \Exception('Le nom de la procédure stockée est obligatoire.');
        }

        $procStatement = 'CALL '.$procName;
        if($numArgs <= 0)
            return $procStatement;
        $procStatement .= '(';
        for ($i = 0; $i<=$numArgs-1; $i++) {
            if($i == $numArgs-1){
                $procStatement .=self::fillValueByDataType($args[$i]);
            }else{$procStatement .= self::fillValueByDataType($args[$i]).',';}
        }
        $procStatement .=');';
        return $procStatement;
    }
    private static function fillValueByDataType($data){
            $DataType = gettype($data);
            if(($data == '' || $data == NULL) && $data != 0)
                return "'". ' '."'";
            if($data === FALSE){
              return 0;
            }else if($data === TRUE){return 1;}
            if($data != null && gettype($data)==='string'){
                $unicode = new UnicodeString($data);
                if($unicode->startsWith('@_')){
                    return $data;
                }
            }
        switch (strtolower($DataType)){
                case 'string':
                    return "'".$data."'";
                    break;
                case 'integer':
                    return intval($data);
                    break;
                case 'date':
                    return "'".$data."'";
                    break;
                case 'datetime':
                    return "'".$data."'";
                    break;
                case 'boolean':
                    return boolval($data);
                    break;
                default:
                    return "'". ' '."'";
                    break;
        }
    }
    public static function ConstructProcV2(string $procName,int $numArgs = 0,array $args = [] , bool $QueryPrepared = false):string{
        if(empty($procName)){
            throw new \Exception('Le nom de la procédure stockée est obligatoire.');
        }
        $procStatement = 'CALL '.$procName;
        if($numArgs <= 0)
            return $procStatement;
        $procStatement .= '(';
        for ($i = 0; $i<=$numArgs-1; $i++) {
            if($i == $numArgs-1){
                if($QueryPrepared)
                    $procStatement .='?';
                else $procStatement .= $args[$i];
            }else{
                if($QueryPrepared){
                    $procStatement .= '?,';
                }else{ $procStatement .= $args[$i].',';}
               }
        }
        $procStatement .=');';
        return $procStatement;
    }
    public static function concatString(){
        $argsNums = func_num_args();
        $funParams = func_get_args();
        $stringRetVal = '';
        if($argsNums <= 0)
            return $stringRetVal;
        $separator = func_get_arg(0);
        if(!preg_match('/^[\s.-_|]{1}$/',$separator)){
            throw new \Exception('Séparateur obligatoire');
        }
        foreach (func_get_args() as $cle => $val){
            if($val == $separator)
                continue;
            if($cle == $argsNums - 1)
                $stringRetVal .= $val;
            else $stringRetVal .= $val.$separator;
        }
        return $stringRetVal;
    }
    public static function stringToBinary($string)
    {
        $characters = str_split($string);
        $binary = [];
        foreach ($characters as $character) {
            $data = unpack('H*', $character);
            $binary[] = base_convert($data[1], 16, 2);
        }
        return implode(' ', $binary);
    }
    public static function binaryToString($binary)
    {
        $binaries = explode(' ', $binary);
        $string = null;
        foreach ($binaries as $binary) {
            $string .= pack('H*', dechex(bindec($binary)));
        }
        return $string;
    }

    public static function getCRC32(object $value):int{
            $valueToBinary = CommonClasses::stringToBinary(strval($value));
            return intval(sprintf('%u',crc32($valueToBinary)));
        }

        public static function verifyCR232(object $value, object $hash):bool{
            $valueToBinary = CommonClasses::stringToBinary(strval($value));
            $crc32Value = sprintf('%u',crc32($valueToBinary));
            if(intval($crc32Value)===intval($hash))
                return true;
            else return false;
        }

        public static function getMD5(mixed $value):string{
            $valueToBinary = CommonClasses::stringToBinary($value);
            $md5Crypt = md5($valueToBinary,false);
            return strval($md5Crypt);
        }

        public static function verifyMd5(object $value, object $hash):bool{
            $valueToBinary = CommonClasses::stringToBinary(strval($value));
            $md5Value =  md5($valueToBinary,false);
            if(strval($md5Value) === strval($hash))
                return true;
            else return false;
        }

}

class JsonSerializer{
    public static function DeserializeMsgJSON(string $msgJSON){
        return json_decode($msgJSON);
    }
    public static function SerializeMsgJSON(object $value){
        return json_encode($value);
    }
}

class Crypto{

    public static function getCRC32(object $value):int{
        $valueToBinary = CommonClasses::stringToBinary(strval($value));
        return intval(sprintf('%u',crc32($valueToBinary)));
    }

    public static function verifyCR232(object $value, object $hash):bool{
        $valueToBinary = CommonClasses::stringToBinary(strval($value));
        $crc32Value = sprintf('%u',crc32($valueToBinary));
        if(intval($crc32Value)===intval($hash))
            return true;
        else return false;
    }

    public static function getMD5(object $value):string{
        $valueToBinary = CommonClasses::stringToBinary($value);
        $md5Crypt = md5($valueToBinary,false);
        return strval($md5Crypt);
    }

    public static function verifyMd5(object $value, object $hash):bool{
        $valueToBinary = CommonClasses::stringToBinary(strval($value));
        $md5Value =  md5($valueToBinary,false);
        if(strval($md5Value) === strval($hash))
            return true;
        else return false;
    }

    public static function getSha1(object $value):string{
        $valueToBinary = CommonClasses::stringToBinary($value);
        $md5Crypt = sha1($valueToBinary,false);
        return strval($md5Crypt);
    }

    public static function verifySha1(object $value, object $hash):bool{
        $valueToBinary = CommonClasses::stringToBinary(strval($value));
        $md5Value =  sha1($valueToBinary,false);
        if(strval($md5Value) === strval($hash))
            return true;
        else return false;
    }

    public static function getCrypt(object $value):string{
        $valueToBinary = CommonClasses::stringToBinary(strval($value));
        $cryptValue =  crypt($valueToBinary);
        return strval($cryptValue);
    }

    public static function verifyCrypt(object $value, object $hash):bool{
        $valueToBinary = CommonClasses::stringToBinary(strval($value));
        $cryptValue =  crypt($valueToBinary,$hash);
        if($cryptValue)
            return true;
        else return false;
    }

}

