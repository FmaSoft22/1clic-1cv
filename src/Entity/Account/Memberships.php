<?php

namespace App\Entity\Account;

use App\Repository\MembershipsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Domains\FmaDomUtilis\CommonClasses;

#[ORM\Entity(repositoryClass: MembershipsRepository::class)]
class Memberships implements UserInterface
{
        #[ORM\Id]
        #[ORM\GeneratedValue(strategy:'AUTO')]
        #[ORM\Column(type: 'integer',name:'UserId')]
        private $ID;

        #[ORM\Column(type: 'array',name:'roles',nullable:true)]
        private $roles;

        #[ORM\Column(type: 'string',name:'Password',length:255,nullable:true)]
        private $Password;

        #[ORM\Column(type: 'string',name:'PassWordSalt',length:1000,nullable:true)]
        private $PassWordSalt;

        #[ORM\Column(type: 'string',name:'IdentityEmail',length:255)]
        private $IdentityEmail;

        #[ORM\Column(type: 'string',name:'IdentityMobilePhone',nullable:true,length:255)]
        private $IdentityMobilePhone;

        #[ORM\Column(type: 'boolean',name:'IsValidated',nullable:true)]
        private $IsValidated;

        #[ORM\Column(type: 'boolean',name:'IsLockedOut',nullable:true)]
        private $IsLockedOut;

        #[ORM\Column(type: 'boolean',name:'IsApprouved',nullable:true)]
        private $IsApprouved;

        #[ORM\Column(type: 'datetime',name:'CreationDate',nullable:true)]
        private $CreationDate;

        #[ORM\Column(type: 'datetime',name:'ModificationDate',nullable:true)]
        private $ModificationDate;

        #[ORM\Column(type: 'datetime',name:'ValidateDate',nullable:true)]
        private $ValidationDate;

        #[ORM\Column(type: 'string',name:'UserToken',length:2000,nullable:true)]
        private $UserToken;

        public function __construct(){
            $this->roles = [];
        }

        #[ORM\OneToOne(
            targetEntity:"App\Entity\Account\UserAccount",
            inversedBy:'memberships'
        )]
        #[ORM\JoinColumn(
            name:'UserAccountID',
            referencedColumnName:'ID',
            unique:true,
            nullable:false
        )]
        private $userAccount;

        public function getID(): ?int
        {
            return $this->ID;
        }

        public function getUsername(){
            return $this->IdentityEmail;
        }

        public function getPassword(){
           return $this->PassWordSalt;
        }

        public function getRoles(){
            return ['ROLE_USER'];
        }
        public  function getSalt(){
            return null;
        }

        public function eraseCredentials(){

        }

}
