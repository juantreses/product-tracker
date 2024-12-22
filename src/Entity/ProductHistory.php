<?php

namespace App\Entity;

use App\Repository\ProductHistoryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductHistoryRepository::class)]
class ProductHistory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $date_from = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $date_until = null;

    #[ORM\ManyToOne(inversedBy: 'productHistories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $product_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getDateFrom(): ?\DateTimeImmutable
    {
        return $this->date_from;
    }

    public function setDateFrom(\DateTimeImmutable $date_from): static
    {
        $this->date_from = $date_from;

        return $this;
    }

    public function getDateUntil(): ?\DateTimeImmutable
    {
        return $this->date_until;
    }

    public function setDateUntil(?\DateTimeImmutable $date_until): static
    {
        $this->date_until = $date_until;

        return $this;
    }

    public function getProductId(): ?Product
    {
        return $this->product_id;
    }

    public function setProductId(?Product $product_id): static
    {
        $this->product_id = $product_id;

        return $this;
    }
}
