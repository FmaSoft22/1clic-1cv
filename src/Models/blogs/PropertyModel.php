<?php

namespace App\Models\blogs;

class PropertyModel
{
        public string $ItemReference ;
        public string $Name ;
        public string $LanguageCode ;
        public string $DisplayName ;
        public string $DataType ;
        public int $Size ;
        public string $Value ;
        public int $IntValue ;
        public bool $BoolValue ;
        public float $DecValue ;
        public \DateTime $DateValue ;
        public string $Unit ;
        public string $UnitList ;
        public bool $IsUnitList ;
        public string $ListValues ;
        public bool $IsValueInList ;
        public bool $DisplayFront ;
        public int $DisplayOrder ;
        public string $ImageLink ;
        public bool $Active ;
}