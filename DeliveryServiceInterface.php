<?php

declare(strict_types=1);

namespace TestovoeGKIntelogis;

interface DeliveryServiceInterface
{
    public function calculateCostAndDate(string $sourceKladr, string $targetKladr, float $weight): array;
}

