<?php

namespace App\Entity;

use App\Repository\CountryCityListRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CountryCityListRepository::class)]
class CountryCityList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;
    private $ZoneGeo;
    private $CountryID;
    private $LabelCountryFR;
    private $LabelCountryEN;
    private $CityListFR;
    private $CitiListEN;
    private $CountryPhoneCode;
    private $CountryFlag;

    public function getId(): ?int
    {
        return $this->id;
    }
}
