<?php

namespace App\Services\FmaServBusiness\Candidates;
use App\Domains\FmaDomBusiness\Candidates;

interface ICandidateService
{
   public function GetCandidate(string $candidateID):Candidate;
   public function DeleteCandidate(string $candidateID);
   public function GetCandidateCareers(string $candidateID);
   public function GetCandidateExperiences(string $candidateID);
   public function GetCandidateEducations(string $candidateID);
   public function GetCandidateSkills(string $candidateID);
   public function GetCandidateLanguages(string $candidateID);
   public function GetCandidateProjects(string $candidateID);
   public function GetCandidateServices(string $candidateID);
   public function InsertUpdateCandidate($reference , $title, $firstname, $lastname, $nickname, $dateOfBirth, $nationality,
   $countryID,$town, $postalCode,$maritalStatus,$address1,$address2,$phone1,$phone2,$drivingLicence,$weight,$size,$availability,$pictureName);
   public function InsertUpdateCandidateV2(Candidate $candidate);


   public function GetCareer(int $careerID,int $candidateID);
   public function InsertUpdateCareer($candidateID, $positionSought,$objective,$positionID,$noticePeriod,$employmentType,$employmentStatus,$salary,$salaryPeriod,$salaryCurrency,$executive,$note);
   public function InsertUpdateCareerV2($career,int $candidateID);
   public function DeleteCareer(int $careerID, int $candidateID);
   public function GetCareerList(int $candidateID);
   public function GetJobLocationList(int $careerID);
   public function GetJobCategoryList(int $careerID);
   public function CareerDetailList(int $candidateID);

   public function GetProExperience(int $experienceID):CandidateExperience;
   public function DeleteProExperience(int $experienceID);
   public function InsertUpdateProExperience($candidateID, $companyID, $title, $description,$startDate, $endDate,$status);
   public function InsertUpdateProExperienceV2(CandidateExperience $experience , int $candidateID);
   public function GetProExperienceList(int $candidateID);

   public function GetLanguage(int $languageID):CandidateLanguage;
   public function DeleteLanguage(int $languageID):bool;
   public function InsertUpdateLanguage($candidateID,$languageID,$level,$yearOfExperience,$lastUsed);
   public function InsertUpdateLanguageV2(CandidateLanguage $candlanguage, int $candidateID);
   public function GetCandidateLanguageList(int $candidateID);

   public function GetSkill(int $skillID):Skill;
   public function DeleteSkill(int $skillID):bool;
   public function InsertUpdateSkill(Skill $skill, int $candidateID);
   public function GetSkillList(int $candidateID);

   public function GetEduction(int $educationID):CandidateEducation;
   public function DeleteEducation(int $educationID);
   public function InsertUpdateEducation(CandidateEducation $education, int $candidateID);
   public function GetEducationList(int $candidateID);

   public function CreateTemplate($name,$reference,$description,$htmlContent,$fileName,$active,$publish);
   public function UpdateTemplate($templateReference, $reference , $description, $htmlContent , $fileName , $active , $public);
   public function DeleteTemplate($templateReference);
   public function GetTemplate($templateReference);
   public function SearchTemplate($filterExpression , $sortExperience);

}

