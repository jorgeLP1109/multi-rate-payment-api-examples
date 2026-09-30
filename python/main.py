import requests

API_KEY = "pk_live_demo123456789"
BASE_URL = "https://multi-rate-payment-api.vercel.app/v1"

headers = {
    "x-api-key": API_KEY,
    "Content-Type": "application/json"
}

# 1. Obtener tasas de cambio
rates_res = requests.get(f"{BASE_URL}/rates/today", headers=headers)
rates_data = rates_res.json()

print("--- Tasas en Tiempo Real ---")
print(f"BCV (USD/VES): {rates_data['rates']['VE']['USD_VES']['value']}")
print(f"Binance P2P (USDT/VES): {rates_data['rates']['CRYPTO']['USDT_VES']['value']}")

# 2. Validar un pago
payment_payload = {
    "reference": "123456",
    "bank_code": "0102",
    "amount": 100.00,
    "payment_method": "PAGO_MOVIL"
}

payment_res = requests.post(f"{BASE_URL}/payments/verify", json=payment_payload, headers=headers)
print("\n--- Resultado de Validación ---")
print(payment_res.json())