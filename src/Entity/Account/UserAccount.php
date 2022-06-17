<?php

namespace App\Entity\Account;

use App\Repository\UserAccountRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserAccountRepository::class)]
class UserAccount
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer',name:'ID')]
    private $id;

    #[ORM\Column(type: 'string',name:'Reference',length:255,nullable:true)]
    private $Reference;

    #[ORM\Column(type: 'string',name:'Pseudo',length:255,nullable:true)]
    private $Pseudo;

    #[ORM\Column(type: 'string',name:'Title',length:50,nullable:true)]
    private $Title;

    #[ORM\Column(type: 'string',name:'FirstName',length:255,nullable:true)]
    private $FirstName;

    #[ORM\Column(type: 'string',name:'MiddleName',length:255,nullable:true)]
    private $MiddleName;

    #[ORM\Column(type: 'string',name:'LastName',length:255,nullable:true)]
    private $LastName;

    #[ORM\Column(type: 'string',name:'EmailAddress1',length:255,nullable:true)]
    private $EmailAddress1;

    #[ORM\Column(type: 'string',name:'EmailAddress2',length:255,nullable:true)]
    private $EmailAddress2;

    #[ORM\Column(type: 'string',name:'Phone1',length:50,nullable:true)]
    private $Phone1;

    #[ORM\Column(type: 'string',name:'Phone2',length:50,nullable:true)]
    private $Phone2;

     #[ORM\Column(type: 'string',name:'Fax',length:50,nullable:true)]
    private $Fax;

    #[ORM\Column(type: 'datetime',name:'LastActivityDate',nullable:true)]
    private $LastActivityDate;

    #[ORM\Column(type: 'datetime',name:'CreationDate',nullable:true)]
    private $CreationDate;

    #[ORM\Column(type: 'datetime',name:'ModificationDate',nullable:true)]
    private $ModificationDate;

    #[ORM\Column(type: 'string',name:'PreferredLanguage',length:50,nullable:true)]
    private $PreferredLanguage;

    #[ORM\Column(type: 'date',name:'DateOfBirth',nullable:true)]
    private $DateOfBirth;

    #[ORM\Column(type: 'string',name:'Town',length:50,nullable:true)]
    private $Town;

    #[ORM\Column(type: 'string',name:'PostalCode',length:50,nullable:true)]
    private $PostalCode;

    #[ORM\Column(type: 'string',name:'CountryCode',length:50,nullable:true)]
    private $CountryCode;

    #[ORM\Column(type: 'string',name:'Guid',length:50,nullable:true)]
    private $Guid;

    #[ORM\Column(type: 'string',name:'Note',length:2000,nullable:true)]
    private $Note;

    #[ORM\Column(type: 'string',name:'PhotoFileName',length:255,nullable:true)]
    private $PhotoFileName;


    #[ORM\OneToOne(
        targetEntity:"App\Entity\Account\Memberships",
        mappedBy:'userAccount'
    )]
    private $memberships;

    public function getId(): ?int
    {
        return $this->id;
    }
}
