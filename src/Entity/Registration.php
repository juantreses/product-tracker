<?php

namespace App\Entity;

use App\Enum\RegistrationType;
use App\Repository\RegistrationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegistrationRepository::class)]
class Registration
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?ProductHistory $product_history_id = null;

    #[ORM\ManyToOne(inversedBy: 'registrations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user_id = null;

    #[ORM\Column(enumType: RegistrationType::class)]
    private ?RegistrationType $registration_type = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $registered_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductHistoryId(): ?ProductHistory
    {
        return $this->product_history_id;
    }

    public function setProductHistoryId(?ProductHistory $product_history_id): static
    {
        $this->product_history_id = $product_history_id;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getRegistrationType(): ?RegistrationType
    {
        return $this->registration_type;
    }

    public function setRegistrationType(RegistrationType $registration_type): static
    {
        $this->registration_type = $registration_type;

        return $this;
    }

    public function getRegisteredAt(): ?\DateTimeImmutable
    {
        return $this->registered_at;
    }

    public function setRegisteredAt(\DateTimeImmutable $registered_at): static
    {
        $this->registered_at = $registered_at;

        return $this;
    }
}
