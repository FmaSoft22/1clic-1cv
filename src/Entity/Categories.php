<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type:'string',name:'name',nullable:true,length:255)]
    private $Name;

    #[ORM\Column(type:'string',name:'description',nullable:true,length:2000)]
    private $Description;

    #[ORM\Column(type:'boolean',name:'active',nullable:true)]
    private $Active;

    #[ORM\Column(type:'string',name:'catImage',nullable:true,length:255)]
    private $CatImage;

    #[ORM\Column(type:'bigint',name:'displayOrder',nullable:true)]
    private $DisplayOrder;

    public function getId(): ?int
    {
        return $this->id;
    }
}
