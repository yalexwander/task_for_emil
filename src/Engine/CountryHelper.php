<?php

namespace App\Engine;

use App\Repository\CountryRepository;
use App\Entity\Country;

class CountryHelper {
    protected $countryRepo;
    
    public function __construct(CountryRepository $countryRepo)
    {
        $this->countryRepo = $countryRepo;
    }
    
    public function detectCountryByTaxNum(string $taxNum) : ?Country {
        $skuPrefix = [];
        if (!preg_match('/^([A-Z]+)/', $taxNum, $skuPrefix)) {
            return null;
        }
        
        return $this->countryRepo->findOneBy([ "sku_prefix" => $skuPrefix[1] ]);
    }
}
