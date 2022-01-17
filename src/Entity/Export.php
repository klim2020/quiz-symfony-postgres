<?php

namespace App\Entity;

use App\Repository\ExportRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExportRepository::class)
 */
class Export
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\Column(type="date")
     */
    private $Data;

    /**
     * @ORM\Column(type="time")
     */
    private $Time;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $DeliveryName;

    /**
     * @ORM\ManyToOne(targetEntity=Location::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $Location;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getData(): ?\DateTimeInterface
    {
        return $this->Data;
    }

    public function setData(\DateTimeInterface $Data): self
    {
        $this->Data = $Data;

        return $this;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->Time;
    }

    public function setTime(\DateTimeInterface $Time): self
    {
        $this->Time = $Time;

        return $this;
    }

    public function getDeliveryName(): ?string
    {
        return $this->DeliveryName;
    }

    public function setDeliveryName(string $DeliveryName): self
    {
        $this->DeliveryName = $DeliveryName;

        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->Location;
    }

    public function setLocation(?Location $Location): self
    {
        $this->Location = $Location;

        return $this;
    }
}
