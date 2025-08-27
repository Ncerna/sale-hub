<?php
namespace Infrastructure\ApiClients;

class ExamplePaymentGatewayClient
{
    private string $apiUrl;
    private string $apiKey;

    public function __construct(string $apiUrl, string $apiKey)
    {
        $this->apiUrl = $apiUrl;
        $this->apiKey = $apiKey;
    }

    public function charge(float $amount, string $currency, string $token): bool
    {
        // Lógica para llamar al API externo y procesar pago
        // Ejemplo simplificado
        // return true si el pago fue exitoso
        return true;
    }
}
