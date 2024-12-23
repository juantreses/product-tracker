<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\Table(name: 'product')]
#[ORM\UniqueConstraint(name: 'UNIQ_CODE', columns: ['code'])]
#[ORM\UniqueConstraint(name: 'UNIQ_NAME', columns: ['name'])]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $code = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    /**
     * @var Collection<int, ProductHistory>
     */
    #[ORM\OneToMany(targetEntity: ProductHistory::class, mappedBy: 'product_id', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $productHistories;

    public function __construct()
    {
        $this->productHistories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection<int, ProductHistory>
     */
    public function getProductHistories(): Collection
    {
        return $this->productHistories;
    }

    public function addProductHistory(ProductHistory $productHistory): static
    {
        if (!$this->productHistories->contains($productHistory)) {
            $this->productHistories->add($productHistory);
            $productHistory->setProductId($this);
        }

        return $this;
    }

    public function removeProductHistory(ProductHistory $productHistory): static
    {
        if ($this->productHistories->removeElement($productHistory)) {
            // set the owning side to null (unless already changed)
            if ($productHistory->getProductId() === $this) {
                $productHistory->setProductId(null);
            }
        }

        return $this;
    }
}
