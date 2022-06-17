<?php

namespace App\Models;
use App\Controller\BaseController;
use App\Domains\FmaDomUtilis\CommonClasses;
use App\Entity\Skills;
use App\Repositories\FmaRepBusiness\StoredFunctions;
use Doctrine\DBAL\Driver\Exception;
use Doctrine\DBAL\DriverManager;

class SkillModel
{
    public $ID;
    public $CandidateID;
    public $Title;
    public $Description;
    public $Level;
    public $YearOfExperience;
    public $LastUsed;
    public $CreationDate;
    public $ModificationDate;
    public $Reference;

    public function __construct($Reference, $title,$description,$level,$yearOfExperience,$lastUsed){
        $this->Description = $description;
        $this->Title = $title;
        $this->Reference = $Reference;
        $this->Level = $level;
        $this->YearOfExperience = $yearOfExperience;
        $this->LastUsed = $lastUsed;
    }

    public  static function GetNewSkillReference(){
        $connectionParams = [
            'url' => $_ENV['DATABASE_URL']
        ];
        $connection = DriverManager::getConnection($connectionParams);
        $reference = $connection->executeQuery('CALL PS_GETSKILLREFERENCE(@SKILLREF);');
        $reference = $connection->fetchOne('SELECT @SKILLREF;');
        return $reference;
    }

    public  static function InsertUpdateSkill($Reference , $candidateReference,$title,$description,$level,$yearOfExperience,$lastUser):bool{
        $argsParams = func_get_args();
        $connectionParams = [
            'url' => $_ENV['DATABASE_URL']
        ];
        $connection = DriverManager::getConnection($connectionParams);
        try{
            $functionParamsLabel = CommonClasses::ConstructProcV1(StoredFunctions::PS_INSERTUPDATE_SKILL,func_num_args(),func_get_args());

            $result = $connection->exec($functionParamsLabel);
            return boolval($result);
        }catch (\Exception $e) {
            throw $e;
        }
    }

    public static function saveSkillModel(SkillModel $model ,$candidateReference):bool{
        try{
           return self::InsertUpdateSkill($model->Reference,$candidateReference,$model->Title,$model->Description,$model->Level,$model->YearOfExperience,$model->LastUsed);
        }catch (Exception $e){
            throw $e;
        }
    }

    public static function getAllSkills(string $candidateGuid):array{
        if(empty($candidateGuid))
            return [];
        setlocale(LC_ALL,'fr-FR');
        $registry = BaseController::getInstance()->doctrineRegistry;
        $em = $registry->getManager()->getRepository('App\Entity\Skills');
        $skills= $em->findBy([
            'CandidateGuid'=> $candidateGuid
        ]);
        $skillList = array();
        foreach($skills as $currentsKill){
            $newSkill = new SkillModel('','','','','','');
            $newSkill->CandidateID = $currentsKill->getCandidateID();
            $newSkill->Description = $currentsKill->getDescription();
            $newSkill->Title = $currentsKill->getTitle();
            $newSkill->Reference = $currentsKill->getReference();
            $newSkill->ID = $currentsKill->getId();
            $newSkill->Level = $currentsKill->getLevel();
            $newSkill->YearOfExperience = $currentsKill->getYearOfExperience();
            $newSkill->LastUsed = $currentsKill->getLastUsed();
            $skillList[] = $newSkill;
        }
        return $skillList;
    }
}