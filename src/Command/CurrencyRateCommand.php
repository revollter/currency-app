<?php

namespace App\Command;

use App\Entity\Currency;
use App\Service\CurrencyService;
use App\Service\HttpService;
use DateInterval;
use DateTime;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class CurrencyRateCommand extends Command
{
    protected static $defaultName = 'app:currency-rate';
    const CURRENCY_TABLE = 'a';

    /**
     * @var CurrencyService
     */
    private $currencyService;

    /**
     * @var HttpService
     */
    private $http;

    /**
     * @var ParameterBagInterface
     */
    private $params;

    /**
     * CurrencyRateCommand constructor.
     * @param CurrencyService $currencyService
     * @param HttpService $http
     * @param ParameterBagInterface $params
     */
    public function __construct(CurrencyService $currencyService, HttpService $http, ParameterBagInterface $params)
    {
        parent::__construct(self::$defaultName);
        $this->currencyService = $currencyService;
        $this->http = $http;
        $this->params = $params;
    }


    protected function configure()
    {
        $this
            ->setDescription('Get curency rates')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        /** @var Currency[] $currencies */
        $currencies = $this->currencyService->getList();
        $date = new DateTime();
        $date->sub(new DateInterval('P1D'));
        $formattedDate = $date->format('Y-m-d');
        $table = self::CURRENCY_TABLE;

        foreach($currencies as $currency) {
            $code = $currency->getCode();
            $result = $this->http->get($this->params->get('nbp_url')."/$table/$code/$formattedDate");
            $effectiveDate = new DateTime($result['rates']['0']['effectiveDate']);
            $rate = $result['rates']['0']['mid'];
            $this->currencyService->rate($effectiveDate, $rate, $currency);
        }

        $io->success('success');
    }
}
