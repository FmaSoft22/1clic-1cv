<?php

namespace App\Models;

use JetBrains\PhpStorm\Pure;

class ColorTemplateModel
{
    public ?string $ColorName;
    public ?string $RgbaColor;
    public ?string $HexValue;
    public ?bool $Default;
    public ?int $DisplayOrder;

    public function __construct($ColorName,$RgbaColor,$HexValue,$DisplayOrder , $Default = false){
        $this->ColorName = $ColorName;
        $this->RgbaColor = $RgbaColor;
        $this->HexValue = $HexValue;
        $this->Default = $Default;
        $this->DisplayOrder = $DisplayOrder;
    }

    #[Pure] public static function getColorList():array{
        $colors = [];
        $color = new ColorTemplateModel(NULL,NULL,'#929496',0,NULL);
        $colors[] = $color;
        $color = new ColorTemplateModel(NULL,NULL,'#f2d8d6',0,NULL);
        $colors[] = $color;
        $color = new ColorTemplateModel(NULL,NULL,'#166c60',0,NULL);
        $colors[] = $color;
        $color = new ColorTemplateModel(NULL,NULL,'#b9481f',1,NULL);
        $colors[] = $color;
        $color = new ColorTemplateModel(NULL,NULL,'#3f3f3f',1,NULL);
        $colors[] = $color;
        $color = new ColorTemplateModel(NULL,NULL,'#f3d281',1,NULL);
        $colors[] = $color;
        $color = new ColorTemplateModel(NULL,NULL,'#fe7966',1,NULL);
        $colors[] = $color;
        return $colors;
    }
}