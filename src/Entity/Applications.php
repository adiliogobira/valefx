<?php

namespace App\Entity;

use App\Repository\ApplicationsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApplicationsRepository::class)]
class Applications
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $no = null;

    #[ORM\Column(length: 255)]
    private ?string $budget = null;

    #[ORM\Column(length: 50)]
    private ?string $month = null;

    #[ORM\Column(length: 50)]
    private ?string $dataAport = null;

    #[ORM\Column(length: 50)]
    private ?string $createdAt = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $updateAt = null;

    #[ORM\Column(length: 50)]
    private ?string $status = null;

    #[ORM\Column(length: 255)]
    private ?string $userId = null;

    #[ORM\Column(length: 255)]
    private ?string $apportId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNo(): ?string
    {
        return $this->no;
    }

    public function setNo(string $no): static
    {
        $this->no = $no;

        return $this;
    }

    public function getBudget(): ?string
    {
        return $this->budget;
    }

    public function setBudget(string $budget): static
    {
        $this->budget = $budget;

        return $this;
    }

    public function getMonth(): ?string
    {
        return $this->month;
    }

    public function setMonth(string $month): static
    {
        $this->month = $month;

        return $this;
    }

    public function getDataAport(): ?string
    {
        return $this->dataAport;
    }

    public function setDataAport(string $dataAport): static
    {
        $this->dataAport = $dataAport;

        return $this;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdateAt(): ?string
    {
        return $this->updateAt;
    }

    public function setUpdateAt(?string $updateAt): static
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getUserId(): ?string
    {
        return $this->userId;
    }

    public function setUserId(string $userId): static
    {
        $this->userId = $userId;

        return $this;
    }

    public function getApportId(): ?string
    {
        return $this->apportId;
    }

    public function setApportId(string $apportId): static
    {
        $this->apportId = $apportId;

        return $this;
    }
}
