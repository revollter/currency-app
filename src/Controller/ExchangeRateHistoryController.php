<?php


namespace App\Controller;


use App\Entity\ExchangeRateHistory;
use App\Form\RateHistoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ExchangeRateHistoryController
 * @package App\Controller
 * @Route("/rates")
 */
class ExchangeRateHistoryController extends AbstractController
{

    /**
     * @Route("/index", name="rates")
     */
    public function index()
    {
        $form = $this->createForm(RateHistoryType::class);

        return $this->render('rateHistory/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

}