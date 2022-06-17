<?php

namespace App\Entity;

use App\Repository\CandidateexperiencesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CandidateexperiencesRepository::class)]
#[ORM\Table(name:'candidateExperience')]
class Candidateexperiences
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy:'AUTO')]
    #[ORM\Column(type: 'bigint',name:'ID')]
    private $ID;

    #[ORM\Column(type:'bigint', name:'candidateID', nullable:false)]
    private $CandidateID;
    #[ORM\Column(type:'string', name:'CandidateGuid', nullable:false)]
    private $CandidateGuid;
    #[ORM\Column(type:'string', name:'Reference', nullable:false)]
    private $Reference;

    #[ORM\Column(type:'bigint',name:'CompanyID',nullable:true)]
    private $CompanyID;

    #[ORM\Column(type:'string',name:'Title',nullable:true,length:255)]
    private $Title;

    #[ORM\Column(type:'string',name:'Description',nullable:true,length:2000)]
    private $Description;

    #[ORM\Column(type:'datetime',name:'StartDate',nullable:true)]
    private $StartDate;

    #[ORM\Column(type:'datetime',name:'EndDate',nullable:true)]
    private $EndDate;

    #[ORM\Column(type:'datetime',name:'CreationDate',nullable:true)]
    private $CreationDate;

    #[ORM\Column(type:'datetime',name:'ModificationDate',nullable:true)]
    private $ModificationDate;

    #[ORM\Column(type:'boolean',name:'Status',nullable:true)]
    private $Status;

    #[ORM\Column(type: 'string',name: 'CompanyName',nullable: true)]
    private  $CompanyName;

    #[ORM\Column(type: 'string',name: 'Wheres',nullable: true)]
    private  $Wheres;

    public function getID()
    {
        return $this->ID;
    }

    /**
     * @param mixed $CandidateGuid
     */
    public function setCandidateGuid($CandidateGuid): void
    {
        $this->CandidateGuid = $CandidateGuid;
    }

    /**
     * @return mixed
     */
    public function getCandidateGuid()
    {
        return $this->CandidateGuid;
    }

    /**
     * @param mixed $ModificationDate
     */
    public function setModificationDate($ModificationDate): void
    {
        $this->ModificationDate = $ModificationDate;
    }

    /**
     * @param mixed $Status
     */
    public function setStatus($Status): void
    {
        $this->Status = $Status;
    }

    /**
     * @param mixed $ID
     */
    public function setID($ID): void
    {
        $this->ID = $ID;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->Status;
    }

    /**
     * @return mixed
     */
    public function getCompanyName()
    {
        return $this->CompanyName;
    }

    /**
     * @return mixed
     */
    public function getWhere()
    {
        return $this->Where;
    }

    /**
     * @param mixed $Where
     */
    public function setWhere($Where): void
    {
        $this->Where = $Where;
    }

    /**
     * @param mixed $CompanyName
     */
    public function setCompanyName($CompanyName): void
    {
        $this->CompanyName = $CompanyName;
    }
    public function getCandidateID():bigint{
            return $this->CandidateID;
    }
    public function getCompanyID():bigint{
        return $this->CompanyID;
    }
    public function getTitle():string{
        return $this->Title;
    }
    public function getDescription():string{
        return $this->Description;
    }
    public function getStartDate(){
        return $this->StartDate;
    }
    public function getEndDate(){
        return $this->EndDate;
    }
    public function getCreationDate():datetime{
        return $this->CreationDate;
    }
    public function getModificationDate():datetime{
        return $this->ModificationDate;
    }
    public function setCandidateID(bigint $candidateID){
        $this->CandidateID = candidateID;
    }
    public function setCompanyID(bigint $compID){
        $this->CompanyID = compID;
    }
    public function setTitle(string $title){
        $this->Title = $title;
    }
    public function setDescription(string $description){
        $this->Description = $description;
    }
    public function setStartDate(datetime $startDate){
        $this->StartDate = startDate;
    }
    public function setEndDate(datetime $endDate){
        $this->EndDate = endDate;
    }
    public function setCreationDate(datetime $createAt){
            $this->CreationDate = $createAt;
     }
    public function setModification(datetime $updateAt){
        $this->ModificationDate = $updateAt;
    }
}
