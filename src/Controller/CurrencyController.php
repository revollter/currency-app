<?php


namespace App\Controller;


use App\Repository\CurrencyRepository;
use App\Service\CurrencyService;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CurrencyController
 * @package App\Controller
 * @Route("/currency")
 */
class CurrencyController extends AbstractController
{
    /**
     * @var CurrencyService
     */
    private $currencyService;

    /**
     * @var CurrencyRepository
     */
    private $currencyRepository;
    /**
     * @var PaginatorInterface
     */
    private $paginator;

    /**
     * CurrencyController constructor.
     * @param CurrencyService $currencyService
     * @param CurrencyRepository $currencyRepository
     * @param PaginatorInterface $paginator
     */
    public function __construct(CurrencyService $currencyService, CurrencyRepository $currencyRepository,  PaginatorInterface $paginator)
    {
        $this->currencyService = $currencyService;
        $this->currencyRepository = $currencyRepository;
        $this->paginator = $paginator;
    }

    /**
     * @Route("/index/{page}", name="currency_list")
     * @param int $page
     * @return Response
     */
    public function index(int $page)
    {
        $query = $this->currencyRepository->findAllQuery();
        $pagination = $this->paginator->paginate($query, $page, 2);

        return $this->render('currency/index.html.twig', [
            'pagination' => $pagination
        ]);
    }

}