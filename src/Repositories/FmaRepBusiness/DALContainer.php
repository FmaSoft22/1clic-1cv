<?php

namespace App\Repositories\FmaRepBusiness;
use App\Repositories\FmaRepBusiness\StoredFunctions;
use App\Domains\FmaDomUtils;
use Doctrine\ORM\EntityRepository;
use Doctrine\DBAL\DriverManager;

class DALContainer
{
    protected  $connectionManager;

    public function __construct(){
        $this->connectionManager = DriverManager::getConnection(getenv('DATABASE_URL'));

    }

    public function InsertUpdateCandidate($reference , $title, $firstname, $lastname, $nickname, $dateOfBirth, $nationality,
                                          $countryID,$town, $postalCode,$maritalStatus,$address1,$address2,$phone1,$phone2,$drivingLicence,$weight,$size,$availability,$pictureName):bool{
        $argsParams = func_get_args();
        try{
            $functionParamsLabel = CommonClasses::ConstructProcV1(StoredFunctions::PS_INSERTUPDATE_CANDIDATE,func_num_args());
            $result = $this->connectionManager->executeStatement();
        }catch (\Exception $e){
            throw $e;
        }
        return true;
    }


}
