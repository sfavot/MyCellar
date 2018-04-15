<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="bottle")
 */
class Bottle
{
    public const DEFAULT_VOLUME = '75cl';

    /**
     * @ORM\Column(type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Wine", inversedBy="bottles", cascade={"persist"})
     * @ORM\JoinColumn(name="wine_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     */
    private $wine;

    /**
     * @ORM\Column(name="acquisition_price", type="float", nullable=true)
     */
    private $acquisitionPrice = null;

    /**
     * @ORM\Column(name="estimation_price", type="float", nullable=true)
     */
    private $estimationPrice = null;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $volume = self::DEFAULT_VOLUME;

    /**
     * @ORM\Column(name="storage_location", type="string", nullable=true)
     */
    private $storageLocation = null;

    public function getId(): string
    {
        return $this->id;
    }

    public function getWine(): Wine
    {
        return $this->wine;
    }

    public function setWine(Wine $wine): self
    {
        $this->wine = $wine;

        return $this;
    }

    public function getAcquisitionPrice(): ?int
    {
        return $this->acquisitionPrice;
    }

    public function setAcquisitionPrice(float $acquisitionPrice): self
    {
        $this->acquisitionPrice = $acquisitionPrice;

        return $this;
    }

    public function getEstimationPrice(): ?int
    {
        return $this->estimationPrice;
    }

    public function setEstimationPrice(float $estimationPrice): self
    {
        $this->estimationPrice = $estimationPrice;

        return $this;
    }

    public function getVolume(): string
    {
        return $this->volume;
    }

    public function setVolume(string $volume): self
    {
        $this->volume = $volume;

        return $this;
    }

    public function getStorageLocation(): ?string
    {
        return $this->storageLocation;
    }

    public function setStorageLocation(string $storageLocation = null): self
    {
        $this->storageLocation = $storageLocation;

        return $this;
    }
}
