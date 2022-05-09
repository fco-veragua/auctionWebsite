<?php

namespace App\Entity;

use App\Repository\UserAuctionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserAuctionRepository::class)]
class UserAuction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    private $bidDate;

    #[ORM\Column(type: 'integer')]
    private $bidValue;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBidDate(): ?\DateTimeInterface
    {
        return $this->bidDate;
    }

    public function setBidDate(\DateTimeInterface $bidDate): self
    {
        $this->bidDate = $bidDate;

        return $this;
    }

    public function getBidValue(): ?int
    {
        return $this->bidValue;
    }

    public function setBidValue(int $bidValue): self
    {
        $this->bidValue = $bidValue;

        return $this;
    }
}
