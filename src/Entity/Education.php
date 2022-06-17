<?php

namespace App\Entity;

use App\Repository\EducationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EducationRepository::class)]
class Education
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name:'ID',type: 'integer')]
    private $ID;
    #[ORM\Column(name:'CandidateID',type: 'integer')]
    private $CandidateID;
    #[ORM\Column(name:'CandidateGuid',type: 'string')]
    private $CandidateGuid;
    #[ORM\Column(name:'Title',type: 'string',length: 255)]
    private $Title;
    #[ORM\Column(name:'Description',type: 'string',length: 2000)]
    private $Description;
    #[ORM\Column(name:'Institution',type: 'string')]
    private $Institution;
    #[ORM\Column(name:'DegreeID',type: 'integer')]
    private $DegreeID;
    #[ORM\Column(name:'CompanyID',type: 'integer')]
    private $CompanyID;
    #[ORM\Column(name:'CountryID',type: 'string')]
    private $CountryID;
    #[ORM\Column(name:'Town', type: 'string')]
    private $Town;
    #[ORM\Column(name:'StartDate', type: 'datetime')]
    private $StartDate;
    #[ORM\Column(name:'EndDate', type: 'datetime')]
    private $EndDate;
    #[ORM\Column(name:'Status', type: 'string')]
    private $Status;
    #[ORM\Column(name:'Major', type: 'string')]
    private $Major;
    #[ORM\Column(name:'LastUsed', type: 'string')]
    private $LastUsed;
    #[ORM\Column(name:'CreationDate', type: 'datetime')]
    private $CreationDate;
    #[ORM\Column(name:'ModificationDate', type: 'datetime')]
    private $ModificationDate;
    #[ORM\Column(type:'string', name:'Reference', nullable:false)]
    private $Reference;


    public function getId(): ?int
    {
        return $this->ID;
    }

    /**
     * @param mixed $LastUsed
     */
    public function setLastUsed($LastUsed): void
    {
        $this->LastUsed = $LastUsed;
    }

    /**
     * @return mixed
     */
    public function getLastUsed()
    {
        return $this->LastUsed;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->Description;
    }

    /**
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->CreationDate;
    }

    /**
     * @param mixed $CreationDate
     */
    public function setCreationDate($CreationDate): void
    {
        $this->CreationDate = $CreationDate;
    }

    /**
     * @param mixed $Title
     */
    public function setTitle($Title): void
    {
        $this->Title = $Title;
    }

    /**
     * @param mixed $Description
     */
    public function setDescription($Description): void
    {
        $this->Description = $Description;
    }

    /**
     * @return mixed
     */
    public function getModificationDate()
    {
        return $this->ModificationDate;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->Title;
    }

    /**
     * @param mixed $CandidateID
     */
    public function setCandidateID($CandidateID): void
    {
        $this->CandidateID = $CandidateID;
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
     * @param mixed $Status
     */
    public function setStatus($Status): void
    {
        $this->Status = $Status;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->StartDate;
    }

    /**
     * @param mixed $CompanyID
     */
    public function setCompanyID($CompanyID): void
    {
        $this->CompanyID = $CompanyID;
    }

    /**
     * @param mixed $Reference
     */
    public function setReference($Reference): void
    {
        $this->Reference = $Reference;
    }

    /**
     * @return mixed
     */
    public function getReference()
    {
        return $this->Reference;
    }

    /**
     * @param mixed $StartDate
     */
    public function setStartDate($StartDate): void
    {
        $this->StartDate = $StartDate;
    }

    /**
     * @param mixed $EndDate
     */
    public function setEndDate($EndDate): void
    {
        $this->EndDate = $EndDate;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->EndDate;
    }

    /**
     * @return mixed
     */
    public function getCompanyID()
    {
        return $this->CompanyID;
    }

    /**
     * @return mixed
     */
    public function getCountryID()
    {
        return $this->CountryID;
    }

    /**
     * @return mixed
     */
    public function getDegreeID()
    {
        return $this->DegreeID;
    }

    /**
     * @return mixed
     */
    public function getInstitution()
    {
        return $this->Institution;
    }

    /**
     * @return mixed
     */
    public function getCandidateID()
    {
        return $this->CandidateID;
    }

    /**
     * @return mixed
     */
    public function getMajor()
    {
        return $this->Major;
    }

    /**
     * @param mixed $CountryID
     */
    public function setCountryID($CountryID): void
    {
        $this->CountryID = $CountryID;
    }

    /**
     * @param mixed $DegreeID
     */
    public function setDegreeID($DegreeID): void
    {
        $this->DegreeID = $DegreeID;
    }

    /**
     * @return mixed
     */
    public function getTown()
    {
        return $this->Town;
    }

    /**
     * @param mixed $Institution
     */
    public function setInstitution($Institution): void
    {
        $this->Institution = $Institution;
    }

    /**
     * @param mixed $Major
     */
    public function setMajor($Major): void
    {
        $this->Major = $Major;
    }

    /**
     * @param mixed $Town
     */
    public function setTown($Town): void
    {
        $this->Town = $Town;
    }
}
