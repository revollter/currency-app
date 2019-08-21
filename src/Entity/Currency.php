<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CurrencyRepository")
 */
class Currency
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ExchangeRateHistory", mappedBy="currency")
     */
    private $exchangeRateHistory;

    public function __construct()
    {
        $this->exchangeRateHistory = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return Collection|ExchangeRateHistory[]
     */
    public function getExchangeRateHistory(): Collection
    {
        return $this->exchangeRateHistory;
    }

    public function addExchangeRateHistory(ExchangeRateHistory $exchangeRateHistory): self
    {
        if (!$this->exchangeRateHistory->contains($exchangeRateHistory)) {
            $this->exchangeRateHistory[] = $exchangeRateHistory;
            $exchangeRateHistory->setCurrency($this);
        }

        return $this;
    }

    public function removeExchangeRateHistory(ExchangeRateHistory $exchangeRateHistory): self
    {
        if ($this->exchangeRateHistory->contains($exchangeRateHistory)) {
            $this->exchangeRateHistory->removeElement($exchangeRateHistory);
            // set the owning side to null (unless already changed)
            if ($exchangeRateHistory->getCurrency() === $this) {
                $exchangeRateHistory->setCurrency(null);
            }
        }

        return $this;
    }
}
