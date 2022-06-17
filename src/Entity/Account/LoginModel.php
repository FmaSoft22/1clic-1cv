<?php

namespace App\Entity\Account;

use App\Repository\LoginModelRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LoginModelRepository::class)]
class LoginModel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'ID' , type: 'integer')]
    private $ID;
    private $EmailAddress;
    private $Password;
    private $remenberMe;

    public function getId(): ?int
    {
        return $this->ID;
    }
}
