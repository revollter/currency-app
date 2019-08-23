<?php


namespace App\Controller;


use App\Form\Model\CurrencySearchModel;
use App\Form\RateHistoryType;
use App\Repository\CurrencyRepository;
use App\Repository\ExchangeRateHistoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ExchangeRateHistoryController
 * @package App\Controller
 * @Route("/rates")
 */
class ExchangeRateHistoryController extends AbstractController
{

    /**
     * @var CurrencyRepository
     */
    private $exchangeRateHistoryRepository;

    /**
     * ExchangeRateHistoryController constructor.
     * @param ExchangeRateHistoryRepository $exchangeRateHistoryRepository
     */
    public function __construct(ExchangeRateHistoryRepository $exchangeRateHistoryRepository)
    {
        $this->exchangeRateHistoryRepository = $exchangeRateHistoryRepository;
    }


    /**
     * @Route("/index", name="rates")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $currencySearchModel = new CurrencySearchModel();
        $form = $this->createForm(RateHistoryType::class, $currencySearchModel);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $ratesHistory = $this->exchangeRateHistoryRepository->findBySearchModel($currencySearchModel);
            return $this->render('rateHistory/index.html.twig', [
                'ratesHistory' => $ratesHistory,
                'form' => $form->createView()
            ]);

        }

        return $this->render('rateHistory/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

}