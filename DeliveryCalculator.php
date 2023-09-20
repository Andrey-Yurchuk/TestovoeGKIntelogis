<?php

declare(strict_types=1);

namespace TestovoeGKIntelogis;

use TestovoeGKIntelogis\DeliveryServiceInterface;
use TestovoeGKIntelogis\FastDeliveryService;
use TestovoeGKIntelogis\SlowDeliveryService;

class DeliveryCalculator
{
    private $deliveryServices = [];

    public function __construct(array $deliveryServices)
    {
        $this->deliveryServices = $deliveryServices;
    }

    public function calculate(array $shipments, string $selectedService): array
    {
        $results = [];

        foreach ($this->deliveryServices as $service) {
            if ($service->getName() === $selectedService) {
                $results[$service->getName()] = $this->calculateService($service, $shipments);
            } else {
                $results[$service->getName()] = $this->emulateService($service, $shipments);
            }
        }

        return $results;
    }

    private function calculateService(DeliveryServiceInterface $service, array $shipments): array
    {
        $results = [];

        foreach ($shipments as $shipment) {
            $result = $service->calculateCostAndDate(
                $shipment['sourceKladr'],
                $shipment['targetKladr'],
                $shipment['weight']
            );

            if ($result['error']) {
                return ['error' => $result['error']];
            }

            $results[] = [
                'price' => $result['price'],
                'date' => $result['date']
            ];
        }

        return $results;
    }

    private function emulateService(DeliveryServiceInterface $service, array $shipments): array
    {
        $results = [];

        foreach ($shipments as $shipment) {
            $results[] = [
                'price' => rand(100, 500),
                'date' => date('Y-m-d', strtotime('+5 days'))
            ];
        }

        return $results;
    }
}