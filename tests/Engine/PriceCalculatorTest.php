<?php

namespace App\Tests\Engine;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Entity\Item;
use App\Entity\Country;
use App\Engine\PriceCalculator;

final class PriceCalculatorTest extends KernelTestCase
{
    public static function setUpBeforeClass(): void
    {
        self::bootKernel();
    }
    
    public function testCalculateSummaryPrice(): void
    {
        $item = new Item();
        $item->setPrice(10000);

        $country = new Country();
        $country->setVat(1000);

        $calc = new PriceCalculator();
        $result = $calc->calculateSummaryPrice($item, $country);
       
        $this->assertSame($result, 11000);
    }
}
