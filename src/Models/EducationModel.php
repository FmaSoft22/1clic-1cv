<?php

namespace App\Models;

use App\Controller\BaseController;
use App\Domains\FmaDomUtilis\CommonClasses;
use App\Entity\Education;
use App\Repositories\FmaRepBusiness\StoredFunctions;
use Doctrine\DBAL\Driver\Exception;
use Doctrine\DBAL\DriverManager;

class EducationModel
{
    public $id;
    public $CandidateGuid;
    public $Title;
    public $Description;
    public $Institution;
    public $DegreeID;
    public $CompanyID;
    public $CountryID;
    public $Town;
    public $StartDate;
    public $EndDate;
    public $Status;
    public $Major;
    public $LastUsed;
    public $CreationDate;
    public $ModificationDate;
    public $Reference;

    public function __construct($Reference, $title,$description,$startDate,$endDate,$institution,$major,$degreeID,$companyID,$countryID,$town,$status,$lastUsed){
        $this->Title = $title;
        $this->Reference = $Reference;
        $this->Description = $description;
        $this->Institution = $institution;
        $this->StartDate = $startDate;
        $this->CountryID = $countryID;
        $this->CompanyID = $companyID;
        $this->Town = $town;
        $this->Status = $status;
        $this->LastUsed = $lastUsed;
        $this->EndDate = $endDate;
        $this->Major = $major;
        $this->DegreeID = $degreeID;
    }

    public  static function GetNewEducationReference(){
        $connectionParams = [
            'url' => $_ENV['DATABASE_URL']
        ];
        $connection = DriverManager::getConnection($connectionParams);
        $reference = $connection->executeQuery('CALL PS_GETEDUCREFERENCE(@EDUCREF);');
        $reference = $connection->fetchOne('SELECT @EDUCREF;');
        return $reference;
    }

    public  static function InsertUpdateEducation($Reference , $candidateReference,$title,$description,$institution,$degreeID,$companyID,$countryID,$town, $startDate, $endDate,$status,$major,$lastUsed):bool{
        $argsParams = func_get_args();
        $connectionParams = [
            'url' => $_ENV['DATABASE_URL']
        ];
        $connection = DriverManager::getConnection($connectionParams);
        try{
            $functionParamsLabel = CommonClasses::ConstructProcV1(StoredFunctions::PS_INSERTUPDATE_EDUCATION,func_num_args(),func_get_args());
            $result = $connection->exec($functionParamsLabel);
            return boolval($result);
        }catch (\Exception $e) {
            throw $e;
        }
    }

    public static function saveEducation(EducationModel $model,$candidateReference):bool{
            try{
                return self::InsertUpdateEducation($model->Reference,$candidateReference,$model->Title,$model->Description,$model->Institution,$model->DegreeID, $model->CompanyID,$model->CountryID,$model->Town,$model->StartDate,$model->EndDate,$model->Status,$model->Major,$model->LastUsed);
            }catch (Exception $e){
                throw $e;
            }
    }

    public static function getAllEduction(string $candidateGuid){
        if(empty($candidateGuid))
            return [];
        setlocale(LC_ALL,'fr-FR');
        $registry = BaseController::getInstance()->doctrineRegistry;
        $em = $registry->getManager()->getRepository('App\Entity\Education');
        $educations = $em->findBy([
            'CandidateGuid'=> $candidateGuid
        ]);
        $educationsList = array();
        foreach($educations as $currentEducation){
            $newEducation = new EducationModel('','','','','','','',''
            ,'','','','','');
            $newEducation->Institution = $currentEducation->getInstitution();
            $newEducation->Status = $currentEducation->getStatus();
            $newEducation->StartDate = strftime('%B %Y',strtotime(($currentEducation->getStartDate()->format('Y-m-d'))));
            $newEducation->EndDate = strftime('%B %Y',strtotime(($currentEducation->getEndDate()->format('Y-m-d'))));
            $newEducation->Reference   = $currentEducation->getReference();
            $newEducation->Title = $currentEducation->getTitle();
            $newEducation->Description = $currentEducation->getDescription();
            $newEducation->CountryID = $currentEducation->getCountryID();
            $newEducation->Town = $currentEducation->getTown();
            $newEducation->Major = $currentEducation->getMajor();

            $educationsList[] = $newEducation;
        }
        return $educationsList;
    }
}