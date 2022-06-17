<?php

namespace App\Entity;

use App\Repository\ExperiencesActivityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExperiencesActivityRepository::class)]
#[ORM\Table(name:'ExperiencesActivity'

)]

class ExperiencesActivity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $ID;

    #[ORM\Column(type: 'bigint')]
    private $ExperienceID;

    #[ORM\Column(type: 'string',length:500)]
    private $History;

    public function getId(): ?int
    {
        return $this->ID;
    }
    public function getHistory(){
        return $this->History;
    }
    public function getExperienceID(){
        return $this->ExperienceID;
    }
    public function setHistory(string $history){
        return $this->History;
    }

}
