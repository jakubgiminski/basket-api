<?php declare(strict_types=1);

namespace App\Controller;

use App\Factory\BasketFactory;
use ShoppingBasket\Money\CalculateTotalCost;
use ShoppingBasket\Money\ConvertCurrency;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CalculateBasketCostController extends AbstractController
{
    private $basketFactory;

    private $calculateTotalCost;

    private $convertCurrency;

    public function __construct(BasketFactory $basketFactory, CalculateTotalCost $calculateTotalCost, ConvertCurrency $convertCurrency)
    {
        $this->basketFactory = $basketFactory;
        $this->calculateTotalCost = $calculateTotalCost;
        $this->convertCurrency = $convertCurrency;
    }

    /**
     * @Route("calculate-basket-cost", methods={"POST"})
     */
    public function __invoke(Request $request): JsonResponse
    {
        $basket = $this->basketFactory->createFromRequest($request);
        $cost = ($this->calculateTotalCost)($basket);
        $costUSD = ($this->convertCurrency)($cost, 'USD');

        return new JsonResponse(['total_basket_cost' => ['amount' => $costUSD->getAmount(), 'currency' => $costUSD->getCurrency()]]);
    }
}
