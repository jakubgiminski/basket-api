<?php declare(strict_types=1);

namespace App\Controller;

use App\Factory\BasketFactory;
use App\Factory\CalculateTotalCost;
use App\Money\ConvertCurrency;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CalculateBasketCostController extends AbstractController
{
    private $basketFactory;

    private $calculateBasketCost;

    private $convertCurrency;

    public function __construct(BasketFactory $basketFactory, CalculateTotalCost $calculateBasketCost, ConvertCurrency $convertCurrency)
    {
        $this->basketFactory = $basketFactory;
        $this->calculateBasketCost = $calculateBasketCost;
        $this->convertCurrency = $convertCurrency;
    }

    /**
     * @Route("calculate-basket-cost", methods={"POST"})
     */
    public function __invoke(Request $request): JsonResponse
    {
        $basket = $this->basketFactory->createFromRequest($request);
        $cost = ($this->calculateBasketCost)($basket);
        $costUSD = ($this->convertCurrency)($cost, 'USD');

        return new JsonResponse(['total_basket_cost' => ['amount' => $costUSD->getAmount(), 'currency' => $costUSD->getCurrency()]]);
    }
}
