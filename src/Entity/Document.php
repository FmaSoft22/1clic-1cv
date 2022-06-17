<?php

namespace App\Entity;

use App\Repository\DocumentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DocumentRepository::class)]
class Document
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;
    private $CandidateID;
    private $Reference;
    private $FileName;
    private $Title;
    private $Description;
    private $CreationDate;
    private $ModificationDate;
    private $DocumentLink;
    private $URI;
    private $Entity;
    private $EntityID;
    private $Version;
    private $DisplayOrder;


    public function getId(): ?int
    {
        return $this->id;
    }
}
