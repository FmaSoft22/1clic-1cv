<?php

namespace App\Entity;

use App\Repository\CareerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CareerRepository::class)]
class Career
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer',name:'careerID')]
    private $ID;

    #[ORM\Column(type:'bigint',name:'candidateID',nullable:false)]
    private $CandidateID;

    #[ORM\Column(type:'string', name:'Reference', nullable:false)]
    private $Reference;


    #[ORM\Column(type:'string',name:'positionSought',length:255,nullable:true)]
    private $PositionSought;

    #[ORM\Column(type:'string',name:'objective',length:255,nullable:true)]
    private $Objective;

    #[ORM\Column(type:'string',name:'noticePeriod',length:255,nullable:true)]
    private $noticePeriod;

    #[ORM\Column(type:'string',name:'employmentType',length:255,nullable:true)]
    private $employmentType;

    #[ORM\Column(type:'string',name:'employmentStatus',length:255,nullable:true)]
    private $employmentStatus;

    #[ORM\Column(type:'string',name:'salary',length:255,nullable:true)]
    private $salary;

    #[ORM\Column(type:'string',name:'salaryPeriod',length:255,nullable:true)]
    private $salaryPeriod;

    #[ORM\Column(type:'string',name:'salaryCurrency',length:255,nullable:true)]
    private $salaryCurrency;

    #[ORM\Column(type:'boolean',name:'executive',nullable:true)]
    private $executive;

    #[ORM\Column(type:'string',name:'note',length:2000,nullable:true)]
    private $note;


    public function getID(): ?int
    {
        return $this->id;
    }

}
