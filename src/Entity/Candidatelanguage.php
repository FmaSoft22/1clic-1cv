<?php

namespace App\Entity;

use App\Repository\CandidatelanguageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CandidatelanguageRepository::class)]
#[ORM\Table(name:'candidateLanguage')]
class Candidatelanguage
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy:'AUTO')]
    #[ORM\Column(type: 'integer')]
    private $ID;

    #[ORM\Column(type:'string', name:'Reference', nullable:false)]
    private $Reference;

    #[ORM\Column(name:'candidateID',type:'bigint',nullable:false)]
    private $CandidateID;

    #[ORM\Column(name:'languageID',type:'bigint',nullable:false)]
    private $LanguageID;

    #[ORM\Column(name:'Level',type:'bigint',nullable:true)]
    private $Level;

    #[ORM\Column(name:'YearOfExperience',type:'string')]
    private $YearOfExperience;

    #[ORM\Column(name:'LastUsed',type:'string')]
    private $LastUsed;

    #[ORM\Column(name:'CreationDate',type:'datetime')]
    private $CreationDate;

    #[ORM\Column(name:'ModificationDate',type:'datetime')]
    private $ModificationDate;

    public function getID(): ?int{
        return $this->ID;
    }
    public function getCandidateID():bigint{
        return $this->CandidateID;
    }
    public function getLanguageID():bigint{
        return $this->LanguageID;
    }
    public function getLevel():bigint{
        return $this->Level;
    }
    public function getYearOfExperience():string{
        return $this->YearOfExperience;
    }
    public function getLastUsed():string{
        return $this->LastUsed;
    }
    public function getCreationDate(){
        return $this->CreationDate;
    }
    public function getModificationDate(){
        return $this->ModificationDate;
    }
    public function setCandidateID(bigint $candID){
        $this->CandidateID = $candID;
    }
    public function setLanguageID(bigint $langID){
        $this->LanguageID = $langID;
    }
    public function setLevel(string $level){
        $this->Level = $level;
    }
    public function setYearOfExperience(string $yearOf){
        $this->YearOfExperience = $yearOf;
    }
    public function setLastUsed(string $lastU){
        $this->LastUsed = $lastU;
    }
    public function setCreationDate(datetime $createAt){
        $this->CreationDate = $createAt;
    }
    public function setModification(datetime $updateAt){
        $this->ModificationDate = $updateAt;
    }
}
