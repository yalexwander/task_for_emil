<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\OrderType;
use App\Engine\PriceCalculator;
use App\Engine\CountryHelper;

class OrderController extends AbstractController
{
    protected CountryHelper $countryHelper;
    protected PriceCalculator $priceCalculator;
    
    public function __construct(CountryHelper $countryHelper, PriceCalculator $priceCalculator)
    {
        $this->countryHelper = $countryHelper;
        $this->priceCalculator = $priceCalculator;
    }
    
    /**
     * @Route("/order/form", name="order_form")
     */
    public function index(Request $request): Response
    {
        $form = $this->createForm(OrderType::class);
        $form->handleRequest($request);
        $summary = [];

        if ($form->isSubmitted() && $form->isValid()) {
            $summary['country'] = $this->countryHelper->detectCountryByTaxNum(
                $form->getData()['tax_num']
            );
            $summary['finalPrice'] = $this->priceCalculator->calculateSummaryPrice(
                $form->getData()['item'], $summary['country']
            );
        }

        return $this->render('order/index.html.twig', [
            'form' => $form->createView(),
            'summary' => $summary
        ]);
    }
}
