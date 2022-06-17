<?php

namespace App\Entity;

use App\Repository\CvTemplateRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CvTemplateRepository::class)]
class CvTemplate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer',name:'ID')]
    private $id;

    #[ORM\Column(type: 'string',length:36,nullable:true,name:'TemplateGuid')]
    private $TemplateGuid;

    #[ORM\Column(type: 'string',length:255,nullable:true,name:'Posted')]
    private $Posted;
    #[ORM\Column(type: 'string',length:255,nullable:true,name:'Reference')]
    private $Reference;

    #[ORM\Column(type: 'string',length:255,name:'TemplateName')]
    private $TemplateName;

    #[ORM\Column(type: 'string',length:1000,name:'Description')]
    private $Description;

    #[ORM\Column(type: 'text',name:'HtmlContent')]
    private $HtmlContent;

    #[ORM\Column(type: 'datetime',nullable:true,name:'CreationDate')]
    private $CreationDate;

    #[ORM\Column(type: 'datetime',nullable:true,name:'ModificationDate')]
    private $ModificationDate;

    #[ORM\Column(type: 'boolean',nullable:true,name:'Active')]
    private $Active;

    public function getId(): ?int{
        return $this->id;
    }
     public function setID(int $ID){
             $this->id = $ID;
        }
    public function getReference(){
        return $this->Reference;
    }
    public function setReference(string $reference){
        $this->Reference = $reference;
    }
    public function getTemplateGuid(){
        return $this->TemplateGuid;
    }
    public function getTemplateName(){
        return $this->TemplateName;
    }
    public function getDescription(){
        return $this->Description;
    }
    public function getHtmlContent(){
        return $this->HtmlContent;
    }
    public function getCreationDate(){
        return $this->CreationDate;
    }
    public function getModificationDate(){
        return $this->ModificationDate;
    }
     public function getPosted(){
            return $this->Posted;
    }
    public function setPosted(string $posted){
            $this->Posted = $posted;
    }
    public function getActive(){
        return $this->Active;
    }
    public function setActive(bool $active){
        $this->Active = $active;
    }
    public function setModificationDate(datetime $updateAt){
        $this->ModificationDate = $date;
    }
    public function setCreationDate(datetime $createAt){
        $this->CreationDate = $date;
    }
    public function setHtmlContent(string $htmlContent){
        $this->HtmlContent = $htmlContent;
    }
    public function setDescription(string $description){
        $this->Description = $description;
    }
    public function setTemplateName(string $templateName){
        $this->TemplateName = $templateName;
    }
    public function setTemplateGuid(string $guid){
        $this->TemplateGuid = $guid;
    }
}
