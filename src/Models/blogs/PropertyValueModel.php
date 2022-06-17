<?php

namespace App\Models\blogs;

class PropertyValueModel
{

    public string $ItemReference ;
    public string $DisplayName ;
    public string $Name ;
    public string $DataType ;
    public string $Value ;
    public int $IntValue ;
    public bool $BoolValue ;
    public \DateTime $DateValue ;
    public float $DecValue ;
    public string $Unit ;
    public int $Size ;
    public string $UnitList ;
    public bool $IsUnitList ;
    public string $ListValues ;
    public bool $IsValueInList ;
    public bool $DisplayFront ;
    public int $DisplayOrder ;
    public string $ImageLink ;
    public bool $Active ;
    public string $LanguageCode ;
}