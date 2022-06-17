<?php

namespace App\Models\blogs;

class CatalogModel
{
        public string $CatalogReference;
        public string $ParentReference;
        public string $CatalogGuid;
        public string $AccountGuid;
        public string $OwnerReference;
        public string $Name;
        public string $Description;
        public \DateTime $CreationDate;
        public \DateTime $ModificationDate;
        public string $Author;
        public string $Modifier;
        public string $PermanentLink;
        public string $LanguageCode;
        public string $CatalogType;
        public bool $Active;
        public bool $Publish;
        public int $DisplayOrder;
        public string $ImageLink;
        public bool $UserCanUse;
        public array $Properties;
        public array $Photos;

        public function __construct(){
            $this->Photos = array();
            $this->Properties = array();
        }
}