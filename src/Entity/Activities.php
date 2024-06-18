<?php

namespace App\Entity;

use App\Repository\ActivitiesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActivitiesRepository::class)]
class Activities
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    /**
     * @var Collection<int, Members>
     */
    #[ORM\ManyToMany(targetEntity: Members::class, inversedBy: 'activities')]
    private Collection $Member;

    #[ORM\ManyToOne(inversedBy: 'activities')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Sections $Section = null;

    /**
     * @var Collection<int, Teams>
     */
    #[ORM\ManyToMany(targetEntity: Teams::class, inversedBy: 'activities')]
    private Collection $team;

    public function __construct()
    {
        $this->Member = new ArrayCollection();
        $this->team = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection<int, Members>
     */
    public function getMember(): Collection
    {
        return $this->Member;
    }

    public function addMember(Members $member): static
    {
        if (!$this->Member->contains($member)) {
            $this->Member->add($member);
        }

        return $this;
    }

    public function removeMember(Members $member): static
    {
        $this->Member->removeElement($member);

        return $this;
    }

    public function getSection(): ?Sections
    {
        return $this->Section;
    }

    public function setSection(?Sections $Section): static
    {
        $this->Section = $Section;

        return $this;
    }

    /**
     * @return Collection<int, Teams>
     */
    public function getTeam(): Collection
    {
        return $this->team;
    }

    public function addTeam(Teams $team): static
    {
        if (!$this->team->contains($team)) {
            $this->team->add($team);
        }

        return $this;
    }

    public function removeTeam(Teams $team): static
    {
        $this->team->removeElement($team);

        return $this;
    }
}
