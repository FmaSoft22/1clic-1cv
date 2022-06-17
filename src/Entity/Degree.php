<?php

namespace App\Entity;

use App\Repository\DegreeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DegreeRepository::class)]
class Degree
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;
    private $Degree;
    private $DegreePercent;
    private $Active;

    public function getId(): ?int
    {
        return $this->id;
    }
}
