<?php

namespace App\Entity;

use App\Repository\EmploymentTypeListRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmploymentTypeListRepository::class)]
class EmploymentTypeList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]

    private $employmentTypeID;
    private $employmentType;

    public function getId(): ?int
    {
        return $this->id;
    }
}
