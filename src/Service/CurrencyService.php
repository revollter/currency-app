<?php

namespace App\Service;

use App\Entity\Currency;
use App\Entity\ExchangeRateHistory;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

class CurrencyService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * CurrencyService constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create(string $name, string $code) : Currency
    {
        $currency = new Currency();
        $currency->setName($name);
        $currency->setCode($code);

        $this->entityManager->persist($currency);
        $this->entityManager->flush();
        return $currency;
    }

    public function rate(DateTime $effectiveDate, float $rate, Currency $currency) : ExchangeRateHistory
    {
        $exchangeRate = new ExchangeRateHistory();
        $exchangeRate->setEffectiveDate($effectiveDate);
        $exchangeRate->setRate($rate);
        $exchangeRate->setCurrency($currency);

        $this->entityManager->persist($exchangeRate);
        $this->entityManager->flush();
        return $exchangeRate;
    }

}