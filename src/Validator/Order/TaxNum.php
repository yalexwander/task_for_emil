<?php

namespace App\Validator\Order;

use Symfony\Component\Validator\Constraint;
use App\Engine\CountryHelper;

class TaxNum extends Constraint {

    public string $message = 'This code does not match any country';
    public string $mode = 'strict';   
    public CountryHelper $countryHelper;
    
    public function __construct($options = null, array $groups = null, $payload = null)
    {
        parent::__construct($options, $groups, $payload);
        $this->countryHelper = $options["countryHelper"];
    }

    public function getTargets(): string
    {
        return self::CLASS_CONSTRAINT;
    }
}
