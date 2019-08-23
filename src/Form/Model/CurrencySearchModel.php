<?php


namespace App\Form\Model;


use App\Entity\Currency;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class CurrencySearchModel
{
    /**
     * @var Collection
     */
    private $currencies;

    /**
     * @var DateTime
     */
    private $dateFrom;

    /**
     * @var DateTime
     */
    private $dateTo;

    /**
     * CurrencySearchModel constructor.
     */
    public function __construct()
    {
        $this->currencies = new ArrayCollection();
    }


    /**
     * @return Collection
     */
    public function getCurrencies(): Collection
    {
        return $this->currencies;
    }

    /**
     * @param Collection $currencies
     */
    public function setCurrencies(Collection $currencies): void
    {
        $this->currencies = $currencies;
    }

    /**
     * @return DateTime
     */
    public function getDateFrom(): ?DateTime
    {
        return $this->dateFrom;
    }

    /**
     * @param DateTime $dateFrom
     */
    public function setDateFrom(DateTime $dateFrom): void
    {
        $this->dateFrom = $dateFrom;
    }

    /**
     * @return DateTime
     */
    public function getDateTo(): ?DateTime
    {
        return $this->dateTo;
    }

    /**
     * @param DateTime $dateTo
     */
    public function setDateTo(DateTime $dateTo): void
    {
        $this->dateTo = $dateTo;
    }

    /**
     * @return ArrayCollection | number[]
     */
    public function getCurrencyIds(): ArrayCollection {
        return $this->currencies->map(function(Currency $currency) { return $currency->getId();});
    }

    public function getFormattedDateFrom($format = 'Y-m-d'): string {
        return $this->dateFrom->format($format);
    }

    public function getFormattedDateTo($format = 'Y-m-d'): string {
        return $this->dateTo->format($format);
    }

}