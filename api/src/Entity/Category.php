<?php


namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ApiResource(
    shortName: 'category',
    normalizationContext: ['groups' => ['category:read']],
    denormalizationContext: ['groups' => ['category:write']],
)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['category:read', 'product:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['category:read', 'category:write', 'product:read'])]
    #[Assert\NotBlank]
    private ?string $name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }
}
