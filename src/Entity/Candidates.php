<?php

namespace App\Entity;

use App\Repository\CandidatesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CandidatesRepository::class)]
class Candidates
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy:'AUTO')]
    #[ORM\Column(type: 'integer',name:'candidateID')]
    private $ID;

    #[ORM\Column(type:'string',name:'Guid',length:36,nullable:true)]
    private $Guid;

    #[ORM\Column(type:'string',name:'Reference',length:255,nullable:true)]
    private $Reference;

    #[ORM\Column(type:'string',name:'Title',length:255,nullable:true)]
    private $Title;

    #[ORM\Column(type:'string',name:'FirstName',length:255,nullable:true)]
    private $FirstName;

    #[ORM\Column(type:'string',name:'LastName',length:255,nullable:true)]
    private $LastName;

    #[ORM\Column(type:'string',name:'MiddleName',length:255,nullable:true)]
    private $MiddleName;

    #[ORM\Column(type:'date',name:'DateOfBirth',nullable:true)]
    private $DateOfBirth;

    #[ORM\Column(type:'string',name:'Nationality',length:255,nullable:true)]
    private $Nationality;

    #[ORM\Column(type:'string',name:'CountryID',length:255,nullable:true)]
    private $CountryID;

    #[ORM\Column(type:'string',name:'Town',length:255,nullable:true)]
    private $Town;

    #[ORM\Column(type:'string',name:'PostalCode',length:255,nullable:true)]
    private $PostalCode;

    #[ORM\Column(type:'string',name:'MaritalStatus',length:255,nullable:true)]
    private $MaritalStatus;

    #[ORM\Column(type:'string',name:'Address1',length:255,nullable:true)]
    private $Address1;

    #[ORM\Column(type:'string',name:'Address2',length:255,nullable:true)]
    private $Address2;

    #[ORM\Column(type:'string',name:'Phone1',length:255,nullable:true)]
    private $Phone1;

    #[ORM\Column(type:'string',name:'Phone2',length:255,nullable:true)]
    private $Phone2;

    #[ORM\Column(type:'string',name:'DrivingLicence',length:255,nullable:false)]
    private $DrivingLicence;

    #[ORM\Column(type:'boolean',name:'Active',nullable:true)]
    private $Active;

    #[ORM\Column(type:'boolean',name:'Publish',nullable:true)]
    private $Publish;

    #[ORM\Column(type:'string',name:'Weight',length:255,nullable:true)]
    private $Weight;

    #[ORM\Column(type:'string',name:'Size',length:255,nullable:true)]
    private $Size;

    #[ORM\Column(type:'datetime',name:'CreationDate',nullable:true)]
    private $CreationDate;

    #[ORM\Column(type:'datetime',name:'ModificationDate',nullable:true)]
    private $ModificationDate;

    #[ORM\Column(type:'boolean',name:'Availability',nullable:true)]
    private $Availability;

    #[ORM\Column(type:'bigint',name:'Score',nullable:true)]
    private $Score;

    #[ORM\Column(type:'datetime',name:'LastConnectionDate',nullable:true)]
    private $LastConnectionDate;

    #[ORM\Column(type:'string',name:'CandidateImage',nullable:true)]
    private $CandidateImage;

    #[ORM\Column(type:'string',length:255,nullable:true)]
    private $EmailAddress;

    #[ORM\Column(type:'string',length:255,nullable:true)]
    private $Position;

    #[ORM\Column(type:'string',length:1000,nullable:true)]
    private $Resume;


    public function getResume(){
        return $this->Resume;
    }
    public function getPosition(){
        return $this->Position;
    }
    public function getEmailAddress(){
        return $this->EmailAddress;
    }
    public function setResume(string $resume){
        $this->Resume = $resume;
    }
    public function setPosition(string $position){
        $this->Position = $position;
    }
    public function setEmailAddress(string $emailAddress){
        $this->EmailAddress = $emailAddress;
    }
    public function getID(): ?int
    {
        return $this->ID;
    }
    public function getGuid():?string{
        return $this->Guid;
    }
    public function getReference():?string{
        return $this->Reference;
    }
    public function getTitle():?string{
        return $this->Title;
    }
    public function getFirstName():?string{
        return $this->FirstName;
    }
    public function getMiddleName():?string{
        return $this->MiddleName;
    }
    public function getLastName():?string{
        return $this->LastName;
    }
    public function getDateOfBirth(){
        return $this->DateOfBirth;
    }
    public function getNationality():?string{
        return $this->Nationality;
    }
    public function getCountryID():?string{
        return $this->CountryID;
    }
    public function getTown():?string{
        return $this->Town;
    }
    public function getPostalCode():?string{
        return $this->PostalCode;
    }
    public function getMaritalStatus():?string{
        return $this->MaritalStatus;
    }
    public function getAddress1():?string{
        return $this->Address1;
    }
    public function getAddress2():?string{
        return $this->Address2;
    }
    public function getPhone1():?string{
        return $this->Phone1;
    }
    public function getPhone2():?String{
        return $this->Phone2;
    }
    public function getDrivingLicence():?string{
        return $this->DrivingLicence;
    }
    public function getActive():bool{
        return $this->Active;
    }
    public function getPublish():bool{
        return $this->Publish;
    }
    public function getWeight(){
        return $this->Weight;
    }
    public function getSize(){
        return $this->Size;
    }
    public function getCreationDate():?datetime{
        return $this->CreationDate;
    }
    public function getModificationDate():?datetime{
        return $this->ModificationDate;
    }
    public function getAvailability():bool{
        return $this->Availability;
    }
    public function getScore():int{
        return $this->Score;
    }
    public function getLastConnectionDate():?datetime{
        return $this->LastConnectionDate;
    }
    public function getCandidateImage():?string{
        return $this->CandidateImage;
    }
    public function setGuid(string $guid){
         $this->Guid = $guid;
    }
    public function setReference(string $reference){
         $this->Reference = $reference;
    }
    public function setTitle(string $title){
         $this->Title = $title;
    }
    public function setFirstName(string $firstName){
         $this->FirstName = $firstName;
    }
    public function setMiddleName(string $middleName){
         $this->MiddleName = $middleName;
    }
    public function setLastName(string $lastName){
         $this->LastName = $lastName;
    }
    public function setDateOfBirth(string $dateOfBirth){
         $this->DateOfBirth = $dateOfBirth;
    }
    public function setNationality(string $nationality){
         $this->Nationality = $nationality;
    }
    public function setCountryID(string $countryID){
         $this->CountryID= $countryID;
    }
    public function setTown(string $town){
         $this->Town = $town;
    }
    public function setPostalCode(string $postalCode){
         $this->PostalCode = $postalCode;
    }
    public function setMaritalStatus(string $maritalStatus){
         $this->MaritalStatus = $maritalStatus;
    }
    public function setAddress1(string $address1){
         $this->Address1 = $address1;
    }
    public function setAddress2(string $address2){
         $this->Address2 = $address2;
    }
    public function setPhone1(string $phone1){
         $this->Phone1 = $phone1;
    }
    public function setPhone2(string $phone2){
        $this->Phone2 = $phone2;
    }
    public function setDrivingLicence(string $drivingL){
         $this->DrivingLicence = $drivingL;
    }
    public function setActive(bool $active){
         $this->Active = $active;
    }
    public function setPublish(bool $publish){
         $this->Publish = $publish;
    }
    public function setWeight(string $weight){
         $this->Weight = $weight;
    }
    public function setSize(string $size){
         $this->Size = $size;
    }
    public function setCreationDate( $createAt){
         $this->CreationDate = $createAt;
    }
    public function setModificationDate( $updateAt){
         $this->ModificationDate = $updateAt;
    }
    public function setAvailability(bool $available){
        return $this->Availability = $available;
    }
    public function setScore(int $score){
        return $this->Score = $score;
    }
    public function setLastConnectionDate(datetime $lastLoginDate){
        return $this->LastConnectionDate = $lastLoginDate;
    }
    public function setCandidateImage(string $candImage){
        return $this->CandidateImage = $candImage;
    }
}
