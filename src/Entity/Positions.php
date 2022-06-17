<?php

namespace App\Entity;

use App\Repository\PositionsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PositionsRepository::class)]
class Positions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;
    private $Position;

    public function getId(): ?int
    {
        return $this->id;
    }
}
