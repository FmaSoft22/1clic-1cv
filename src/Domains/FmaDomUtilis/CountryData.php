<?php

namespace Fma\Dom\Utils;

class CountryData
{
    private $ZoneCode;
    private $CountryName;
    private $CountryCode;
    private $PhoneCode;
    private $Flag;
    private $Lang;

    public function __construct(string $zoneCode,string $countryName,string $countryCode,string $phoneCode,string $flag,string $lang){
        $this->ZoneCode = $zoneCode;
        $this->CountryCode = $countryCode;
        $this->CountryName = $countryName;
        $this->Flag = $flag;
        $this->Lang = $lang;
        $this->PhoneCode = $phoneCode;
    }

    public function setLang(string $lang){
        $this->Lang = $lang;
    }
    public  function setPhoneCode(string $phoneCode){
        $this->PhoneCode = $phoneCode;
    }
    public  function setCountryCode(string $countryCode){
        $this->CountryCode = $countryCode;
    }
    public  function setCountryName(string $countryName){
        $this->CountryName = $countryName;
    }
    public  function setFlag(string $flag){
        $this->Flag = $flag;
    }
    public function setZoneCode(string $zoneCode){
        $this->ZoneCode = $zoneCode;
    }

    public function getPhoneCode(){
        return $this->PhoneCode;
    }
    public function getCountryName(){
        return $this->CountryName;
    }
    public function getCountryCode(){
        return $this->CountryCode;
    }
    public function getZoneCode(){
        return $this->ZoneCode;
    }
    public function getLang(){
        return $this->Lang;
    }
    public  function getFlag(){
        return $this->Flag;
    }
}
