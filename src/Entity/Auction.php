<?php

namespace App\Entity;

use App\Repository\AuctionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
// use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AuctionRepository::class)]
#[Vich\Uploadable]
/**
 * @Vich\Uploadable // neccesary for bundle
 */
class Auction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'string', length: 255)]
    private $description;

    #[ORM\Column(type: 'string', length: 255)]
    private $state;

    #[ORM\Column(type: 'integer')]
    private $price;

    #[ORM\Column(type: 'datetime')]
    private $startDate;

    #[ORM\Column(type: 'datetime')]
    private $closingDate;

    #[Vich\UploadableField(mapping: 'photos', fileNameProperty: 'photosName')]
    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="photos", fileNameProperty="photosName")
     * 
     * @var File|null
     */
    private $photosFile;

    #[ORM\Column(type: 'string')]
    private $photosName;

    #[ORM\Column(type: 'datetime')]
    private $updateAt;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'auctions')]
    #[ORM\JoinColumn(nullable: false)]
    private $category;

    #[ORM\OneToMany(mappedBy: 'auction', targetEntity: UserAuction::class)]
    private $userAuctions;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'auctions')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    public function __construct()
    {
        $this->userAuctions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getClosingDate(): ?\DateTimeInterface
    {
        return $this->closingDate;
    }

    public function setClosingDate(\DateTimeInterface $closingDate): self
    {
        $this->closingDate = $closingDate;

        return $this;
    }

    public function getPhotosFile(): ?File
    {
        return $this->photosFile;
    }

    public function setPhotosFile(?File $photosFile = null): void
    {
        $this->photosFile = $photosFile;

        if (null !== $photosFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getPhotosName(): ?string
    {
        return $this->photosName;
    }

    public function setPhotosName(?string $photosName): void
    {
        $this->photosName = $photosName;
    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->updateAt;
    }

    public function setUpdateAt(\DateTimeInterface $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, UserAuction>
     */
    public function getUserAuctions(): Collection
    {
        return $this->userAuctions;
    }

    public function addUserAuction(UserAuction $userAuction): self
    {
        if (!$this->userAuctions->contains($userAuction)) {
            $this->userAuctions[] = $userAuction;
            $userAuction->setAuction($this);
        }

        return $this;
    }

    public function removeUserAuction(UserAuction $userAuction): self
    {
        if ($this->userAuctions->removeElement($userAuction)) {
            // set the owning side to null (unless already changed)
            if ($userAuction->getAuction() === $this) {
                $userAuction->setAuction(null);
            }
        }

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
