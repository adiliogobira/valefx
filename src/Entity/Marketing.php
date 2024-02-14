<?php

namespace App\Entity;

use App\Repository\MarketingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MarketingRepository::class)]
class Marketing
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $subtitle = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $countView = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $usersCreated = null;

    #[ORM\Column(length: 50)]
    private ?string $status = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    public function setSubtitle(string $subtitle): static
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    public function getCountView(): ?string
    {
        return $this->countView;
    }

    public function setCountView(?string $countView): static
    {
        $this->countView = $countView;

        return $this;
    }

    public function getUsersCreated(): ?string
    {
        return $this->usersCreated;
    }

    public function setUsersCreated(?string $usersCreated): static
    {
        $this->usersCreated = $usersCreated;

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
}
