<?php

declare(strict_types=1);

namespace TestovoeGKIntelogis;

use TestovoeGKIntelogis\DeliveryServiceInterface;
use TestovoeGKIntelogis\DeliveryCalculator;

class SlowDeliveryService implements DeliveryServiceInterface
{
    private $baseUrl;

    public function __construct(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    public function calculateCostAndDate(string $sourceKladr, string $targetKladr, float $weight): array
    {
        $basePrice = 150;
        $coefficient = $this->calculateCoefficient($weight);

        $price = $basePrice * $coefficient;

        // пример вычисления даты доставки
        $currentDate = new DateTime();
        $period = mt_rand(5, 10);
        $deliveryDate = $currentDate->add(new DateInterval("P{$period}D"))->format('Y-m-d');

        return [
            'price' => $price,
            'date' => $deliveryDate,
            'error' => ''
        ];
    }

    public function getName(): string
    {
        return 'Медленная доставка';
    }

    protected function calculateCoefficient(float $weight): float
    {
        // придуманная логика расчета коэффициента на основе веса
        return 1 + ($weight / 10);
    }
}