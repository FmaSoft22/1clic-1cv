<?php

namespace App\Entity;

use App\Repository\YearOfExperienceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: YearOfExperienceRepository::class)]
class YearOfExperience
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;
    private $Name;

    public function getId(): ?int
    {
        return $this->id;
    }
}
