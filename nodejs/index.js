const API_KEY = 'pk_live_demo123456789';
const BASE_URL = 'https://multi-rate-payment-api.vercel.app/v1';

async function run() {
  try {
    // 1. Obtener tasas del día
    const ratesResponse = await fetch(`${BASE_URL}/rates/today`, {
      headers: { 'x-api-key': API_KEY }
    });
    const ratesData = await ratesResponse.json();
    console.log('--- Tasas en Tiempo Real ---');
    console.log(`BCV (USD/VES): ${ratesData.rates.VE.USD_VES.value}`);
    console.log(`Binance P2P (USDT/VES): ${ratesData.rates.CRYPTO.USDT_VES.value}`);

    // 2. Validar un pago
    const paymentResponse = await fetch(`${BASE_URL}/payments/verify`, {
      method: 'POST',
      headers: {
        'x-api-key': API_KEY,
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        reference: '123456',
        bank_code: '0102',
        amount: 100.00,
        payment_method: 'PAGO_MOVIL'
      })
    });
    const paymentData = await paymentResponse.json();
    console.log('\n--- Resultado de Validación ---');
    console.log(paymentData);
  } catch (error) {
    console.error('Error al consultar la API:', error);
  }
}

run();