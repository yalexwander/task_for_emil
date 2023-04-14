<?php

namespace App\Validator\Order;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class TaxNumValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        if (null === $constraint->countryHelper->detectCountryByTaxNum($value)) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}
