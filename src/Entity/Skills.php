<?php

namespace App\Entity;

use App\Repository\SkillsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SkillsRepository::class)]
class Skills
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name:'ID', type: 'integer')]
    private $ID;
    #[ORM\Column(name:'CandidateID',type: 'bigint')]
    private $CandidateID;
    #[ORM\Column(name:'CandidateGuid',type: 'string')]
    private $CandidateGuid;
    #[ORM\Column(name:'Title', type: 'string')]
    private $Title;
    #[ORM\Column(type:'string', name:'Reference', nullable:false)]
    private $Reference;

    #[ORM\Column(name: 'Description', type: 'string', length: 2000, nullable: true)]
    private $Description;
    #[ORM\Column(name: 'Level', type: 'bigint',  nullable: true)]
    private $Level;
    #[ORM\Column(name: 'YearOfExperience', type: 'string',  nullable: true)]
    private $YearOfExperience;
    #[ORM\Column(name: 'LastUsed', type: 'string',  nullable: true)]
    private $LastUsed;
    #[ORM\Column(name: 'CreationDate', type: 'datetime',  nullable: true)]
    private $CreationDate;
    #[ORM\Column(name: 'ModificationDate', type: 'datetime',  nullable: true)]
    private $ModificationDate;

    public function getId(): ?int
    {
        return $this->ID;
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
    public function getReference()
    {
        return $this->Reference;
    }

    /**
     * @param mixed $Reference
     */
    public function setReference($Reference): void
    {
        $this->Reference = $Reference;
    }

    /**
     * @param mixed $ModificationDate
     */
    public function setModificationDate($ModificationDate): void
    {
        $this->ModificationDate = $ModificationDate;
    }

    /**
     * @return mixed
     */
    public function getCandidateGuid()
    {
        return $this->CandidateGuid;
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
    public function getCandidateID()
    {
        return $this->CandidateID;
    }

    /**
     * @param mixed $CandidateID
     */
    public function setCandidateID($CandidateID): void
    {
        $this->CandidateID = $CandidateID;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->Title;
    }

    /**
     * @return mixed
     */
    public function getModificationDate()
    {
        return $this->ModificationDate;
    }

    /**
     * @param mixed $Description
     */
    public function setDescription($Description): void
    {
        $this->Description = $Description;
    }

    /**
     * @param mixed $Title
     */
    public function setTitle($Title): void
    {
        $this->Title = $Title;
    }

    /**
     * @param mixed $CreationDate
     */
    public function setCreationDate($CreationDate): void
    {
        $this->CreationDate = $CreationDate;
    }

    /**
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->CreationDate;
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
    public function getLastUsed()
    {
        return $this->LastUsed;
    }

    /**
     * @return mixed
     */
    public function getLevel()
    {
        return $this->Level;
    }

    /**
     * @return mixed
     */
    public function getYearOfExperience()
    {
        return $this->YearOfExperience;
    }

    /**
     * @param mixed $LastUsed
     */
    public function setLastUsed($LastUsed): void
    {
        $this->LastUsed = $LastUsed;
    }

    /**
     * @param mixed $Level
     */
    public function setLevel($Level): void
    {
        $this->Level = $Level;
    }

    /**
     * @param mixed $YearOfExperience
     */
    public function setYearOfExperience($YearOfExperience): void
    {
        $this->YearOfExperience = $YearOfExperience;
    }
}
