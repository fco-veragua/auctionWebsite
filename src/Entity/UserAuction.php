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

    #[ORM\ManyToOne(targetEntity: Auction::class, inversedBy: 'userAuctions')]
    #[ORM\JoinColumn(nullable: false)]
    private $auction;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'userAuctions')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

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

    public function getAuction(): ?Auction
    {
        return $this->auction;
    }

    public function setAuction(?Auction $auction): self
    {
        $this->auction = $auction;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
