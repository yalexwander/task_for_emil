<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class MoneyFormatFilter extends AbstractExtension
{
    public function getFilters() : array
    {
        return [
            new TwigFilter('fmt_money', [$this, 'formatMoney']),
        ];
    }

    public function formatMoney($number) : string
    {
        $format = number_format($number / 100 + ($number % 100) / 100, 2, ',', ' ');

        return $format;
    }
}
