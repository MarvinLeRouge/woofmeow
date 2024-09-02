<?php

namespace App\Entity;

use App\Repository\PrescriptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PrescriptionRepository::class)]
class Prescription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'prescriptions')]
    private ?Visit $visit = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $startDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $endDate = null;

    /**
     * @var Collection<int, PrescriptionLine>
     */
    #[ORM\OneToMany(targetEntity: PrescriptionLine::class, mappedBy: 'prescription', orphanRemoval: true)]
    private Collection $prescriptionLines;

    public function __construct()
    {
        $this->prescriptionLines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVisit(): ?Visit
    {
        return $this->visit;
    }

    public function setVisit(?Visit $visit): static
    {
        $this->visit = $visit;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): static
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): static
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * @return Collection<int, PrescriptionLine>
     */
    public function getPrescriptionLines(): Collection
    {
        return $this->prescriptionLines;
    }

    public function addPrescriptionLine(PrescriptionLine $prescriptionLine): static
    {
        if (!$this->prescriptionLines->contains($prescriptionLine)) {
            $this->prescriptionLines->add($prescriptionLine);
            $prescriptionLine->setPrescription($this);
        }

        return $this;
    }

    public function removePrescriptionLine(PrescriptionLine $prescriptionLine): static
    {
        if ($this->prescriptionLines->removeElement($prescriptionLine)) {
            // set the owning side to null (unless already changed)
            if ($prescriptionLine->getPrescription() === $this) {
                $prescriptionLine->setPrescription(null);
            }
        }

        return $this;
    }
}
