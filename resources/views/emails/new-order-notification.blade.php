<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Nuevo pedido</title>
<style>
  body { font-family: Arial, sans-serif; background: #f5f5f5; margin: 0; padding: 20px; color: #333; }
  .container { max-width: 580px; margin: 0 auto; background: #ffffff; border-radius: 12px; overflow: hidden; }
  .header { background: #2C3628; color: #ffffff; padding: 24px 28px; }
  .header h1 { font-size: 20px; margin: 0 0 4px; }
  .header p { font-size: 13px; margin: 0; color: #C9A96E; }
  .body { padding: 28px; }
  .badge { background: #D1FAE5; color: #065F46; font-weight: bold; padding: 6px 14px; border-radius: 20px; font-size: 13px; display: inline-block; margin-bottom: 20px; }
  .section-title { font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; color: #888; margin: 20px 0 8px; }
  .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; font-size: 14px; margin-bottom: 20px; }
  .info-item .label { font-size: 11px; color: #888; margin-bottom: 2px; }
  .info-item .value { font-weight: 600; color: #2C3628; }
  .items-table { width: 100%; border-collapse: collapse; font-size: 14px; margin-bottom: 20px; }
  .items-table th { text-align: left; padding: 8px 10px; background: #f9f9f9; font-size: 11px; text-transform: uppercase; color: #666; }
  .items-table td { padding: 10px 10px; border-bottom: 1px solid #f0f0f0; }
  .total-row td { font-weight: bold; background: #f9f9f9; border-top: 2px solid #e0e0e0; }
  .cta-btn { display: inline-block; background: #2C3628; color: #ffffff; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: bold; font-size: 14px; }
  .footer { background: #f5f5f5; padding: 16px 28px; text-align: center; font-size: 12px; color: #999; }
</style>
</head>
<body>
<div class="container">
  <div class="header">
    <h1>🛍️ Nuevo pedido recibido</h1>
    <p>Un Tesoro Para Mamá — Panel de administración</p>
  </div>
  <div class="body">
    <div class="badge">✅ Pago confirmado</div>

    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
      <div>
        <div style="font-size:20px; font-weight:bold; color:#2C3628;">{{ $order->order_number }}</div>
        <div style="font-size:12px; color:#888;">{{ $order->created_at->format('d/m/Y H:i') }}</div>
      </div>
      <div style="font-size:24px; font-weight:bold; color:#2C3628;">${{ number_format($order->total, 2) }}</div>
    </div>

    <div class="section-title">Datos del cliente</div>
    <div class="info-grid">
      <div class="info-item"><div class="label">Nombre</div><div class="value">{{ $order->customer_name }}</div></div>
      <div class="info-item"><div class="label">Email</div><div class="value">{{ $order->customer_email }}</div></div>
      <div class="info-item"><div class="label">Teléfono</div><div class="value">{{ $order->customer_phone }}</div></div>
      <div class="info-item"><div class="label">Ciudad</div><div class="value">{{ $order->customer_city }}, {{ $order->customer_country }}</div></div>
    </div>
    <div style="font-size:13px; color:#555; margin-bottom:20px;">
      <span style="font-size:11px; color:#888; display:block; margin-bottom:2px;">DIRECCIÓN</span>
      {{ $order->customer_address }}
    </div>
    @if($order->customer_notes)
    <div style="background:#FFF8E1; padding:12px; border-radius:8px; font-size:13px; margin-bottom:20px;">
      <strong>Notas del cliente:</strong> {{ $order->customer_notes }}
    </div>
    @endif

    <div class="section-title">Productos</div>
    <table class="items-table">
      <thead>
        <tr>
          <th>Producto</th>
          <th>Variante</th>
          <th style="text-align:center;">Qty</th>
          <th style="text-align:right;">Subtotal</th>
        </tr>
      </thead>
      <tbody>
        @foreach($order->items as $item)
        <tr>
          <td>{{ $item->product_name }}</td>
          <td>{{ $item->variant_name ?? '—' }}</td>
          <td style="text-align:center;">{{ $item->quantity }}</td>
          <td style="text-align:right;">${{ number_format($item->subtotal, 2) }}</td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr class="total-row">
          <td colspan="3"><strong>Total</strong></td>
          <td style="text-align:right;"><strong>${{ number_format($order->total, 2) }}</strong></td>
        </tr>
      </tfoot>
    </table>

    <div style="text-align:center; margin-top:24px;">
      <a href="{{ route('admin.orders.show', $order) }}" class="cta-btn">Ver pedido en el panel admin</a>
    </div>
  </div>
  <div class="footer">
    <p>Este correo es una notificación automática del sistema.</p>
  </div>
</div>
</body>
</html>
