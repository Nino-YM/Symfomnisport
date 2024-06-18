<?php

namespace App\Entity;

use App\Repository\TeamsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamsRepository::class)]
class Teams
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Activities>
     */
    #[ORM\ManyToMany(targetEntity: Activities::class, mappedBy: 'team')]
    private Collection $activities;

    /**
     * @var Collection<int, Members>
     */
    #[ORM\ManyToMany(targetEntity: Members::class, mappedBy: 'team')]
    private Collection $members;

    public function __construct()
    {
        $this->activities = new ArrayCollection();
        $this->members = new ArrayCollection();
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

    /**
     * @return Collection<int, Activities>
     */
    public function getActivities(): Collection
    {
        return $this->activities;
    }

    public function addActivity(Activities $activity): static
    {
        if (!$this->activities->contains($activity)) {
            $this->activities->add($activity);
            $activity->addTeam($this);
        }

        return $this;
    }

    public function removeActivity(Activities $activity): static
    {
        if ($this->activities->removeElement($activity)) {
            $activity->removeTeam($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Members>
     */
    public function getMembers(): Collection
    {
        return $this->members;
    }

    public function addMember(Members $member): static
    {
        if (!$this->members->contains($member)) {
            $this->members->add($member);
            $member->addTeam($this);
        }

        return $this;
    }

    public function removeMember(Members $member): static
    {
        if ($this->members->removeElement($member)) {
            $member->removeTeam($this);
        }

        return $this;
    }
}
