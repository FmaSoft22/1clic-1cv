<?php

namespace App\Models;

use App\Entity\Candidateexperiences;
use App\Controller\BaseController;
use App\Models\ActivityModel;
use App\Repositories\FmaRepBusiness\StoredFunctions;
use Doctrine\DBAL\Driver\Exception;
use Doctrine\DBAL\DriverManager;
use App\Domains\FmaDomUtilis\CommonClasses;


class CandidateExperiencesModel {

        public $ID;
        public $CandidateID;
        public $CompanyID;
        public $Reference;
        public $Title;
        public $Description;
        public $StartDate;
        public $EndDate;
        public $CreationDate;
        public $ModificationDate;
        public $Status;
        public $DateFormat;
        public $CompanyName;
        public $Where;
        public $Activity = array();

        public function __construct($Reference, $title,$description,$companyName,$startDate,$endDate,$status,$where){
            $this->Title = $title;
            $this->Reference = $Reference;
            $this->Description = $description;
            $this->CompanyName = $companyName;
            $this->EndDate = $endDate;
            $this->StartDate = $startDate;
            $this->Status = $status;
            $this->Where = $where;
        }

        public  static function GetNewExpereinceReference(){
            $connectionParams = [
                'url' => $_ENV['DATABASE_URL']
            ];
            $connection = DriverManager::getConnection($connectionParams);
            $reference = $connection->executeQuery('CALL PS_GETEXPERIENCEREFERENCE(@EXPERIENCEREF);');
            $reference = $connection->fetchOne('SELECT @EXPERIENCEREF;');
            return $reference;
        }
    public  static function InsertUpdateExperience($Reference , $candidateReference,$title,$description, $startDate, $endDate,$status,$companyName,$wheres):bool{
        $argsParams = func_get_args();
        $connectionParams = [
            'url' => $_ENV['DATABASE_URL']
        ];
        $connection = DriverManager::getConnection($connectionParams);
        try{
            $functionParamsLabel = CommonClasses::ConstructProcV1(StoredFunctions::PS_INSERTUPDATE_EXPERIENCE,func_num_args(),func_get_args());
            $result = $connection->exec($functionParamsLabel);
            return boolval($result);
        }catch (\Exception $e) {
            throw $e;
        }
    }

    public static function saveExperience(CandidateExperiencesModel $model,string $candidateReference):bool{
            try{
                return self::InsertUpdateExperience($model->Reference,$candidateReference,$model->Title,$model->Description,$model->StartDate,$model->EndDate,$model->Status,$model->CompanyName,$model->Where);
            }catch (Exception $e){
                throw $e;
            }
        }

        public static function getAllCandidateExperience(string $candidateGuid):array{
            if(empty($candidateGuid))
                return [];
             setlocale(LC_ALL,'fr-FR');
             $registry = BaseController::getInstance()->doctrineRegistry;
             $em = $registry->getManager()->getRepository('App\Entity\Candidateexperiences');
             $experiences = $em->findBy([
                 'CandidateGuid'=> $candidateGuid
             ]);
             $allExperiences = array();
             foreach($experiences as $curExp){
                    $experience = new CandidateExperiencesModel('','','','',''
                    ,'','','');
                    $experience->Title = $curExp->getTitle();
                    $experience->Description = $curExp->getDescription();
                    $experience->StartDate = strftime('%B %Y',strtotime(($curExp->getStartDate()->format('Y-m-d'))));
                    $experience->EndDate = strftime('%B %Y',strtotime(($curExp->getEndDate()->format('Y-m-d'))));
                    $experience->Activity = self::getActivityList($curExp->getID());
                    $experience->CompanyName = $curExp->getCompanyName();
                    $allExperiences[] = $experience;
             }
             $date = new \DateTime();
             return $allExperiences;
        }

        public static function getActivityList($experienceID){
            if(empty($experienceID))
                return [];
            $registry = BaseController::getInstance()->doctrineRegistry;
            $em = $registry->getManager()->getRepository('App\Entity\ExperiencesActivity');
            $activity = $em->findBy([
                'ExperienceID'=> $experienceID
            ]);
            return ActivityModel::convertToActivityModel($activity);
        }
}