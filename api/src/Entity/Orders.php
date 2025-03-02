<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\OrdersRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: OrdersRepository::class)]
#[ApiResource(
    shortName: 'orders',
    operations: [
        new Get(
            security: 'is_granted("ROLE_ORDER_VIEW")',
        ),
        new GetCollection(),
        new Post(security: 'is_granted("ROLE_ORDER_MANAGE")'),
        new Put(
            security: 'is_granted("ROLE_ORDER_MANAGE")'
        ),
        new Patch(
            security: 'is_granted("ROLE_ORDER_MANAGE")'
        ),
        new Delete(
            security: 'is_granted("ROLE_ADMIN")'
        )
    ],
    normalizationContext: ['groups' => ['orders:read']],
    denormalizationContext: ['groups' => ['orders:write']]
)]
class Orders
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Product::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['orders:read', 'orders:write'])]
    private ?Product $product = null;

    #[ORM\Column]
    #[Assert\GreaterThan(0)]
    #[Groups(['orders:read', 'orders:write'])]
    private ?int $quantity = 0;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['orders:read', 'orders:write'])]
    private ?User $owner = null;

    #[ORM\Column(length: 255)]
    #[Groups(['orders:read', 'orders:write'])]
    private ?string $status = null;

    #[ORM\Column]
    #[Groups(['orders:read'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    #[Groups(['orders:read'])]
    private ?\DateTimeImmutable $updatedAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;
        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): void
    {
        $this->owner = $owner;
    }


    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
