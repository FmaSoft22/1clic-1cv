<?php

namespace App\Entity;

use App\Repository\TempTemplateRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TempTemplateRepository::class)]
#[ORM\Table(name: 'TempTemplate')]
class TempTemplate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $ID;
    #[ORM\Column(name: 'Reference',type: 'string')]
    private string  $Reference;
    #[ORM\Column(type: 'string')]
    private string $Guid;
    #[ORM\Column(type: 'integer')]
    private int $CandidateID;
    #[ORM\Column(type: 'string')]
    private string $CandidateGuid;
    #[ORM\Column(type: 'string',name: 'TemplateGuid',nullable: true)]
    private string $TemplateGuid;
    #[ORM\Column(type: 'string',name: 'Color',nullable: true)]
    private string $Color;
    #[ORM\Column(type: 'boolean',name: 'IsSaved',nullable: true)]
    private bool $IsSaved;
    #[ORM\Column(type: 'string',name: 'AccountGuid',nullable: true)]
    private string $AccountGuid;

    public function getId(): ?int
    {
        return $this->ID;
    }

    /**
     * @param int $Guid
     */
    public function setGuid(int $Guid): void
    {
        $this->Guid = $Guid;
    }

    /**
     * @return int
     */
    public function getGuid(): int
    {
        return $this->Guid;
    }
    /**
     * @param int $CandidateGuid
     */
    public function setCandidateGuid(int $CandidateGuid): void
    {
        $this->CandidateGuid = $CandidateGuid;
    }

    /**
     * @return int
     */
    public function getCandidateGuid(): int
    {
        return $this->CandidateGuid;
    }

    /**
     * @param int $ID
     */
    public function setID(int $ID): void
    {
        $this->ID = $ID;
    }

    /**
     * @param int $CandidateID
     */
    public function setCandidateID(int $CandidateID): void
    {
        $this->CandidateID = $CandidateID;
    }

    /**
     * @return int
     */
    public function getCandidateID(): int
    {
        return $this->CandidateID;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->Color;
    }

    /**
     * @return string
     */
    public function getTemplateGuid(): string
    {
        return $this->TemplateGuid;
    }

    /**
     * @return bool
     */
    public function isIsSaved(): bool
    {
        return $this->IsSaved;
    }

    /**
     * @param string $Color
     */
    public function setColor(string $Color): void
    {
        $this->Color = $Color;
    }

    /**
     * @param bool $IsSaved
     */
    public function setIsSaved(bool $IsSaved): void
    {
        $this->IsSaved = $IsSaved;
    }

    /**
     * @param string $TemplateGuid
     */
    public function setTemplateGuid(string $TemplateGuid): void
    {
        $this->TemplateGuid = $TemplateGuid;
    }

    /**
     * @return string
     */
    public function getAccountGuid(): string
    {
        return $this->AccountGuid;
    }

    /**
     * @param string $AccountGuid
     */
    public function setAccountGuid(string $AccountGuid): void
    {
        $this->AccountGuid = $AccountGuid;
    }
}
