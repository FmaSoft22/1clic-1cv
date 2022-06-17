<?php

namespace App\Common;
use App\Models\ColorTemplateModel;
use Doctrine\DBAL\DriverManager;

class ClsCommonWeb
{
    public  static function sortColorArray( $color1, $color2){
        if($color1->DisplayOrder != null < $color2->DisplayOrder)
            return -1;
        else if($color1->DisplayOrder == $color2->DisplayOrder)
            return 0;
        else if($color1->DisplayOrder > $color2->DisplayOrder)
            return 1;
    }

    public  static function GetTmpTemplateReference(){
        $connectionParams = [
            'url' => $_ENV['DATABASE_URL']
        ];
        $connection = DriverManager::getConnection($connectionParams);
        $reference = $connection->executeQuery('CALL PS_GETTMPTMPREFERENCE(@TMPTMP);');
        $reference = $connection->executeQuery('SELECT @TMPTMP;');
        return $reference;
    }
}
