<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompanyRepository::class)]
class Company
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $ID;
    private $CandidateID;
    private $Guid;
    private $Name;
    private $Holding;
    private $RegisterNumber;
    private $ActivityCode;
    private $ActivityDescription;
    private $CountryID;
    private $Town;
    private $PostalCode;
    private $CompanyLogo;
    private $WebSite;
    private $Email;
    private $Address1;
    private $Address2;
    private $Phone;
    private $Fax;
    private $Note;
    private $CreationDate;
    private $ModificationDate;

    public function getId(): ?int
    {
        return $this->id;
    }
}
