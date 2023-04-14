<?php

namespace App\Engine;
use App\Entity\Country;
use App\Entity\Item;

class PriceCalculator {
    public function calculateSummaryPrice(Item $item, Country $country): int {
        $finalPrice = $item->getPrice() + ( $item->getPrice() * $country->getVat() / 10000 );

        return $finalPrice;
    }
}
