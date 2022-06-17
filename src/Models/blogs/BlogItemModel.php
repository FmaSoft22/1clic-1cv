<?php

namespace App\Models\blogs;

class BlogItemModel
{
    public  int $ItemID;
    public string $Guid;
    public string $ItemReference;
    public string $CatalogReference;
    public string $CatalogName;
    public string $AccountGuid;
    public string $Reference;
    public string $OwnerReference;
    public string $Name;
    public  string $Description;
    public string $Title;
    public \DateTime $CreationDate;
    public \DateTime $ModificationDate;
    public string $Author;
    public string $Modifier;
    public string $LanguageCode;
    public string $ItemType;
    public bool $Active;
    public bool $Authorize;
    public bool $Publish;
    public string $location;
    public string $countryCode;
    public string $TownLocation;
    public string $Town;
    public string $WebSite;
    public array $Properties;
    public array $ImagesUpload;
    public array $Photos;
    public array $MediaUpload;
    public array $Media;
    public string $Contact;
    public string $Phone1;
    public string $Phone2;
    public string $CountryPhoneCode;
    public string $CountryPhoneCode2;
    public string $emailAddress1;
    public string $emailAddress2;

    public  function __construct(){
        $this->Properties = array();
        $this->Photos = array();
        $this->ImagesUpload = array();
        $this->MediaUpload = array();
        $this->Media =array();
    }

    public static function saveItem(BlogItemModel $item,string $catalogReference,string $accountGuid,$languageCode){
        if(empty($item))
            return false;
        try{
            $itemReference = '';
        }catch (\Exception $e){

        }
    }
}