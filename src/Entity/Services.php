<?php

namespace App\Entity;

use App\Repository\ServicesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServicesRepository::class)]
class Services
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;
    private $Reference;
    private $Title;
    private $Description;
    private $CreationDate;
    private $ModificationDate;
    private $Price;
    private $Currency;
    private $FrontImage;
    private $InPromotion;
    private $PromoPercent;
    private $Category;

    public function getId(): ?int
    {
        return $this->id;
    }
}
