<?php

namespace App\Entity\Cash;

use App\Entity\Core\CoreEntity;
use App\Entity\User\BaseUser;
use App\Enum\Cash\CashTransactionType;
use App\Repository\Cash\CashTransactionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CashTransactionRepository::class)]
class CashTransaction implements CoreEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    #[Assert\NotNull]
    private ?\DateTimeInterface $transactionDate = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    #[Assert\NotNull]
    #[Assert\Positive]
    private ?string $amount = null;

    #[ORM\Column(enumType: CashTransactionType::class)]
    #[Assert\NotNull]
    private ?CashTransactionType $transactionType = null;

    #[ORM\ManyToOne(targetEntity: BaseUser::class)]
    private ?BaseUser $createdBy = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getTransactionDate(): ?\DateTimeInterface
    {
        return $this->transactionDate;
    }

    public function setTransactionDate(\DateTimeInterface $transactionDate): self
    {
        $this->transactionDate = $transactionDate;
        return $this;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    public function getTransactionType(): ?CashTransactionType
    {
        return $this->transactionType;
    }

    public function setTransactionType(CashTransactionType $transactionType): self
    {
        $this->transactionType = $transactionType;
        return $this;
    }

    public function getCreatedBy(): ?BaseUser
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?BaseUser $createdBy): self
    {
        $this->createdBy = $createdBy;
        return $this;
    }
} 