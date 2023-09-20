<?php

declare(strict_types=1);

namespace TestovoeGKIntelogis;

use TestovoeGKIntelogis\DeliveryServiceInterface;
use TestovoeGKIntelogis\DeliveryCalculator;

class FastDeliveryService implements DeliveryServiceInterface
{
    private $baseUrl;

    public function __construct(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    public function calculateCostAndDate(string $sourceKladr, string $targetKladr, float $weight): array
    {
        $price = $weight * 10; // умножаем вес отправления на придуманный фиксированный тариф

        // пример вычисления даты доставки
        $currentDate = new DateTime();
        $period = mt_rand(2, 5);
        $deliveryDate = $currentDate->add(new DateInterval("P{$period}D"))->format('Y-m-d');

        return [
            'price' => $price,
            'date' => $deliveryDate,
            'error' => ''
        ];
    }

    public function getName(): string
    {
        return 'Быстрая доставка';
    }
}
