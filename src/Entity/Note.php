<?php

namespace App\Entity;

use App\Repository\UserRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Exclude;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Note
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'text')]
    private string $note;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $createdDateTime;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?DateTimeImmutable $updatedDateTime = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    #[Exclude]
    private User $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): string
    {
        return $this->note;
    }

    public function setNote(string $note): void
    {
        $this->note = $note;
    }

    public function getCreatedDateTime(): DateTimeImmutable
    {
        return $this->createdDateTime;
    }

    public function getUpdatedDateTime(): DateTimeImmutable
    {
        return $this->updatedDateTime;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    #[ORM\PrePersist]
    public function doBeforePersist(): void
    {
        $this->createdDateTime = new DateTimeImmutable();
    }

    #[ORM\PreUpdate]
    public function doBeforeUpdate(): void
    {
        $this->updatedDateTime = new DateTimeImmutable();
    }
}