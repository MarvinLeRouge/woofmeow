<?php

namespace App\Entity;

use App\Enum\MedicationFrequency;
use App\Enum\MedicationUnit;
use App\Repository\PrescriptionLineRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PrescriptionLineRepository::class)]
class PrescriptionLine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'prescriptionLines')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Prescription $prescription = null;

    #[ORM\Column(length: 255)]
    private ?string $drugName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $batchNumber = null;

    #[ORM\Column]
    private ?int $dosage = null;

    #[ORM\Column(enumType: MedicationUnit::class)]
    private ?MedicationUnit $unit = null;

    #[ORM\Column(enumType: MedicationFrequency::class)]
    private ?MedicationFrequency $frequency = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $startDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $endDate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrescription(): ?Prescription
    {
        return $this->prescription;
    }

    public function setPrescription(?Prescription $prescription): static
    {
        $this->prescription = $prescription;

        return $this;
    }

    public function getDrugName(): ?string
    {
        return $this->drugName;
    }

    public function setDrugName(string $drugName): static
    {
        $this->drugName = $drugName;

        return $this;
    }

    public function getBatchNumber(): ?string
    {
        return $this->batchNumber;
    }

    public function setBatchNumber(?string $batchNumber): static
    {
        $this->batchNumber = $batchNumber;

        return $this;
    }

    public function getDosage(): ?int
    {
        return $this->dosage;
    }

    public function setDosage(int $dosage): static
    {
        $this->dosage = $dosage;

        return $this;
    }

    public function getUnit(): ?MedicationUnit
    {
        return $this->unit;
    }

    public function setUnit(MedicationUnit $unit): static
    {
        $this->unit = $unit;

        return $this;
    }

    public function getFrequency(): ?MedicationFrequency
    {
        return $this->frequency;
    }

    public function setFrequency(MedicationFrequency $frequency): static
    {
        $this->frequency = $frequency;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(?\DateTimeInterface $startDate): static
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTimeInterface $endDate): static
    {
        $this->endDate = $endDate;

        return $this;
    }
}
