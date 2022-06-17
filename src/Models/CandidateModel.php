<?php
namespace App\Models;
use App\Controller\BaseController;
use App\Entity\Candidates;
use App\Models\CandidateExperiencesModel;
use App\Repositories\FmaRepBusiness\StoredFunctions;
use Doctrine\DBAL\DriverManager;
use App\Domains\FmaDomUtilis\CommonClasses;

class CandidateModel {

        public $ID;
        public $Guid;
        public $Reference;
        public $Title;
        public $FirstName;
        public $LastName;
        public $MiddleName;
        public $DateOfBirth;
        public $Nationality;
        public $CountryID;
        public $Town;
        public $PostalCode;
        public $MaritalStatus;
        public $Address1;
        public $Address2;
        public $Phone1;
        public $Phone2;
        public $DrivingLicence;
        public $Active;
        public $Publish;
        public $Weight;
        public $Size;
        public $CreationDate;
        public $ModificationDate;
        public $Availability;
        public $Score;
        public $LastConnectionDate;
        public $CandidateImage;
        public $EmailAddress;
        public $Resume;
        public $Position;
        public $experiences = array();
        public $skills = array();
        public $educations = array();



        public function __construct($reference , $title, $firstname, $lastname, $middlename, $dateOfBirth, $nationality,
                                    $countryID,$town, $postalCode,$maritalStatus,$address1,$address2,$phone1,$phone2,$drivingLicence,$active, $publish, $weight,$size,$score,$emailAddress, $position,$resume,$availability,$CandidateImage){
            $this->Reference = $reference;
            $this->Title = $title;
            $this->FirstName = $firstname;
            $this->LastName = $lastname;
            $this->CountryID = $countryID;
            $this->Town = $town;
            $this->MiddleName = $middlename;
            $this->Position = $position;
            $this->PostalCode = $postalCode;
            $this->MaritalStatus = $maritalStatus;
            $this->Address2 = $address2;
            $this->Address1 = $address1;
            $this->Nationality = $nationality;
            $this->DrivingLicence = $drivingLicence;
            $this->Active = $active;
            $this->Publish = $publish;
            $this->Score = $score;
            $this->Size = $size;
            $this->Weight = $weight;
            $this->Phone2 = $phone2;
            $this->Availability = $availability;
            $this->CandidateImage = $CandidateImage;
            $this->DateOfBirth = $dateOfBirth;
            $this->Resume = $resume;
            $this->Position = $position;
            $this->Address1 = $address1;
            $this->Phone1 = $phone1;
            $this->EmailAddress = $emailAddress;
            $this->skills = array();
            $this->educations = array();
            $this->experiences = array();
        }

        public  static function GetNewCandidateReference(){
            $connectionParams = [
                'url' => $_ENV['DATABASE_URL']
            ];
            $connection = DriverManager::getConnection($connectionParams);
            $reference = $connection->executeQuery('CALL PS_GETCANDIDATEREFERENCE(@CANDIDATEREF);');
            $reference = $connection->fetchOne('SELECT @CANDIDATEREF;');
            return $reference;
        }

    public static function InsertUpdateCandidate($reference , $title, $firstname, $lastname, $middlename, $dateOfBirth, $nationality,
                                          $countryID,$town, $postalCode,$maritalStatus,$address1,$address2,$phone1,$phone2,$drivingLicence,$active, $publish, $weight,$size,$score,$emailAddress, $position,$resume,$availability,$CandidateImage):bool{
        $argsParams = func_get_args();

        $connectionParams = [
            'url' => $_ENV['DATABASE_URL']
        ];
        $connection = DriverManager::getConnection($connectionParams);
        try{
            $functionParamsLabel = CommonClasses::ConstructProcV1(StoredFunctions::PS_INSERTUPDATE_CANDIDATE,func_num_args(),func_get_args());
            $result = $connection->exec($functionParamsLabel);
            return boolval($result);
        }catch (\Exception $e) {
            throw $e;
        }
    }

    public static function  saveCandidate(CandidateModel $model):bool{
       // $registry = BaseController::getInstance()->doctrineRegistry;
        try{
           return self::InsertUpdateCandidate($model->Reference,$model->Title,$model->FirstName,$model->LastName,$model->MiddleName,$model->DateOfBirth,$model->Nationality,$model->CountryID
            ,$model->Town,$model->PostalCode,$model->MaritalStatus,$model->Address1,$model->Address2,$model->Phone1,$model->Phone2,$model->DrivingLicence,
            $model->Active,$model->Publish,$model->Weight,$model->Size,$model->Score,$model->EmailAddress,$model->Position,$model->Resume,$model->Availability,$model->CandidateImage);
        }catch (\Exception $e){
            throw $e;
        }
        return $model->Reference;
    }

        public static function getCandidate(string $candGuid){
             $registry = BaseController::getInstance()->doctrineRegistry;
             $em = $registry->getManager()->getRepository('App\Entity\Candidates');
             $candidate = $em->findOneBy([
             'Guid'=>$candGuid]);
             if(empty($candidate))
                return null;
             $newCandidate = new CandidateModel('','','','','','',''
             ,'','','','','','','','','','','','','','','','','','','');
             $newCandidate->ID = $candidate->getID();
             $newCandidate->Guid = $candidate->getGuid();
             $newCandidate->Title = $candidate->getTitle();
             $newCandidate->FirstName = $candidate->getFirstName();
             $newCandidate->LastName =  $candidate->getLastName();
             $newCandidate->DateOfBirth = $candidate->getDateOfBirth();
             $newCandidate->MiddleName = $candidate->getMiddleName();
             $newCandidate->Nationality = $candidate->getNationality();
             $newCandidate->CountryID = $candidate->getCountryID();
             $newCandidate->Town = $candidate->getTown();
             $newCandidate->PostalCode = $candidate->getPostalCode();
             $newCandidate->MaritalStatus = $candidate->getMaritalStatus();
             $newCandidate->Address1 = $candidate->getAddress1();
             $newCandidate->Address2 = $candidate->getAddress2();
             $newCandidate->Phone2 = '';
             $newCandidate->Phone1 = $candidate->getPhone1();
             $newCandidate->DrivingLicence = $candidate->getDrivingLicence();
             $newCandidate->Weight = $candidate->getWeight();
             $newCandidate->Size = $candidate->getSize();
             $newCandidate->Score = $candidate->getScore();
             $newCandidate->CandidateImage = $candidate->getCandidateImage();
             $newCandidate->Resume = $candidate->getResume();
             $newCandidate->EmailAddress = $candidate->getEmailAddress();
             $newCandidate->Position = $candidate->getPosition();
             $newCandidate->experiences = CandidateExperiencesModel::getAllCandidateExperience($candidate->getGuid());
             $newCandidate->skills = SkillModel::getAllSkills($candidate->getGuid());
             $newCandidate->educations = EducationModel::getAllEduction($candidate->getGuid());
             return $newCandidate;
         }

}