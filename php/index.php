<?php

$apiKey = 'pk_live_demo123456789';
$baseUrl = 'https://multi-rate-payment-api.vercel.app/v1';

// 1. Obtener tasas
$ch = curl_init("$baseUrl/rates/today");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "x-api-key: $apiKey"
]);
$response = curl_exec($ch);
curl_close($ch);

$ratesData = json_decode($response, true);
echo "--- Tasas en Tiempo Real ---\n";
echo "BCV (USD/VES): " . $ratesData['rates']['VE']['USD_VES']['value'] . "\n";
echo "Binance P2P (USDT/VES): " . $ratesData['rates']['CRYPTO']['USDT_VES']['value'] . "\n\n";

// 2. Validar un pago
$paymentData = [
    'reference' => '123456',
    'bank_code' => '0102',
    'amount' => 100.00,
    'payment_method' => 'PAGO_MOVIL'
];

$ch = curl_init("$baseUrl/payments/verify");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($paymentData));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "x-api-key: $apiKey",
    "Content-Type: application/json"
]);
$paymentResponse = curl_exec($ch);
curl_close($ch);

echo "--- Resultado de Validación ---\n";
echo $paymentResponse . "\n";