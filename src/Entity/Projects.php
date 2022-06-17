<?php

namespace App\Entity;

use App\Repository\ProjectsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectsRepository::class)]
class Projects
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;
    private $ProjetTitle;
    private $ProjetDescription;
    private $StartDate;
    private $EndDate;
    private $Status;
    private $CompanyID;
    private $URL;
    private $CreationDate;
    private $ModificationDate;
    private $FrontImageURI;
    private $Publish;
    private $Active;
    private $CategoryID;

    public function getId(): ?int
    {
        return $this->id;
    }
}
