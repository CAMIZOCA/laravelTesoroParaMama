<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pedido confirmado</title>
<style>
  body { font-family: Georgia, serif; background: #FAF7F2; margin: 0; padding: 20px; color: #3D4A35; }
  .container { max-width: 580px; margin: 0 auto; background: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
  .header { background: #2C3628; color: #ffffff; padding: 36px 32px; text-align: center; }
  .header h1 { font-size: 22px; margin: 0 0 6px; font-weight: bold; }
  .header p { font-size: 14px; margin: 0; color: #C9A96E; }
  .body { padding: 32px; }
  .greeting { font-size: 16px; margin-bottom: 20px; }
  .order-number { background: #F5E6C8; color: #8B6914; font-weight: bold; padding: 10px 16px; border-radius: 8px; display: inline-block; font-size: 14px; margin-bottom: 24px; }
  .items-table { width: 100%; border-collapse: collapse; font-size: 14px; margin-bottom: 20px; }
  .items-table th { text-align: left; padding: 8px 12px; background: #F2EDE6; color: #4A5240; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; }
  .items-table td { padding: 12px 12px; border-bottom: 1px solid #F2EDE6; vertical-align: top; }
  .items-table .variant { font-size: 12px; color: #888; }
  .total-row { background: #FAF7F2; font-weight: bold; }
  .total-row td { padding: 14px 12px; border-top: 2px solid #E5DDD0; }
  .address-box { background: #F2EDE6; border-radius: 10px; padding: 16px; font-size: 14px; margin-bottom: 24px; }
  .address-box p { margin: 0 0 4px; }
  .address-box .label { font-size: 11px; text-transform: uppercase; color: #888; letter-spacing: 0.5px; margin-bottom: 2px; }
  .cta-btn { display: inline-block; background: #C9A96E; color: #ffffff; padding: 14px 28px; border-radius: 50px; text-decoration: none; font-weight: bold; font-size: 14px; margin: 8px 0; }
  .steps { counter-reset: step; }
  .step { display: flex; gap: 12px; margin-bottom: 12px; font-size: 14px; }
  .step-num { background: #F5E6C8; color: #8B6914; width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 12px; flex-shrink: 0; }
  .footer { background: #F2EDE6; padding: 20px 32px; text-align: center; font-size: 12px; color: #888; }
  .footer a { color: #C9A96E; text-decoration: none; }
</style>
</head>
<body>
<div class="container">
  <div class="header">
    <h1>¡Tu pedido está confirmado!</h1>
    <p>Un Tesoro Para Mamá</p>
  </div>
  <div class="body">
    <p class="greeting">Hola <strong>{{ $order->customer_name }}</strong>,</p>
    <p style="font-size:14px; margin-bottom:20px;">Hemos recibido tu pedido con éxito. Estamos preparando todo con mucho cariño para ti. 💛</p>

    <div class="order-number">Pedido {{ $order->order_number }}</div>

    <table class="items-table">
      <thead>
        <tr>
          <th>Producto</th>
          <th style="text-align:right;">Subtotal</th>
        </tr>
      </thead>
      <tbody>
        @foreach($order->items as $item)
        <tr>
          <td>
            <strong>{{ $item->product_name }}</strong>
            @if($item->variant_name)
              <div class="variant">{{ $item->variant_name }}</div>
            @endif
            <div class="variant">Cantidad: {{ $item->quantity }} × ${{ number_format($item->product_price, 2) }}</div>
          </td>
          <td style="text-align:right;">${{ number_format($item->subtotal, 2) }}</td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr class="total-row">
          <td><strong>Total pagado</strong></td>
          <td style="text-align:right;"><strong>${{ number_format($order->total, 2) }}</strong></td>
        </tr>
      </tfoot>
    </table>

    <div class="address-box">
      <p class="label">Dirección de envío</p>
      <p><strong>{{ $order->customer_name }}</strong></p>
      <p>{{ $order->customer_address }}</p>
      <p>{{ $order->customer_city }}, {{ $order->customer_country }}</p>
      <p>{{ $order->customer_phone }}</p>
    </div>

    <h3 style="font-size:15px; color:#2C3628; margin-bottom:12px;">¿Qué sigue?</h3>
    <div class="steps">
      <div class="step"><div class="step-num">1</div><p>Prepararemos tu kit con cuidado en los próximos días hábiles.</p></div>
      <div class="step"><div class="step-num">2</div><p>Recibirás un correo con el número de guía cuando tu paquete esté en camino.</p></div>
      <div class="step"><div class="step-num">3</div><p>Al recibir tu kit, sigue las instrucciones para crear tu joya única.</p></div>
    </div>

    <div style="text-align:center; margin-top:28px;">
      <a href="{{ route('instrucciones') }}" class="cta-btn">Ver instrucciones del kit</a>
    </div>

    <p style="font-size:13px; color:#888; margin-top:24px;">¿Tienes alguna pregunta? Escríbenos, estamos aquí para ayudarte. 💬</p>
  </div>
  <div class="footer">
    <p>Un Tesoro Para Mamá — Kits DIY de joyería de leche materna</p>
    <p>Este correo fue enviado a {{ $order->customer_email }}</p>
  </div>
</div>
</body>
</html>
