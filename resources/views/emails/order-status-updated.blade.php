<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Actualización de tu pedido</title>
<style>
  body { font-family: Georgia, serif; background: #FAF7F2; margin: 0; padding: 20px; color: #3D4A35; }
  .container { max-width: 560px; margin: 0 auto; background: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
  .header { background: #2C3628; color: #ffffff; padding: 32px; text-align: center; }
  .header h1 { font-size: 20px; margin: 0 0 4px; }
  .header p { font-size: 13px; margin: 0; color: #C9A96E; }
  .body { padding: 28px; }
  .status-badge { text-align: center; margin: 20px 0; }
  .status-badge span { display: inline-block; padding: 10px 24px; border-radius: 50px; font-weight: bold; font-size: 15px; }
  .status-processing { background: #DBEAFE; color: #1E40AF; }
  .status-shipped { background: #EDE9FE; color: #5B21B6; }
  .status-delivered { background: #D1FAE5; color: #065F46; }
  .status-other { background: #F3F4F6; color: #374151; }
  .tracking-box { background: #F5E6C8; border-radius: 10px; padding: 16px; text-align: center; margin: 20px 0; }
  .tracking-box .label { font-size: 12px; color: #8B6914; margin-bottom: 4px; }
  .tracking-box .number { font-size: 20px; font-weight: bold; color: #2C3628; letter-spacing: 1px; }
  .footer { background: #F2EDE6; padding: 16px 28px; text-align: center; font-size: 12px; color: #888; }
</style>
</head>
<body>
<div class="container">
  <div class="header">
    <h1>Actualización de tu pedido</h1>
    <p>Un Tesoro Para Mamá — {{ $order->order_number }}</p>
  </div>
  <div class="body">
    <p style="font-size:15px;">Hola <strong>{{ $order->customer_name }}</strong>,</p>
    <p style="font-size:14px; color:#555;">Tu pedido ha sido actualizado:</p>

    <div class="status-badge">
      @php
        $statusClass = match($order->status) {
          'processing' => 'status-processing',
          'shipped' => 'status-shipped',
          'delivered' => 'status-delivered',
          default => 'status-other'
        };
        $statusText = match($order->status) {
          'processing' => '📦 En preparación',
          'shipped' => '🚚 Enviado',
          'delivered' => '✅ Entregado',
          default => $order->statusLabel()
        };
      @endphp
      <span class="{{ $statusClass }}">{{ $statusText }}</span>
    </div>

    @if($order->status === 'processing')
    <div style="background:#EFF6FF; border-radius:10px; padding:16px; font-size:14px; margin:20px 0; text-align:center;">
      <p style="margin:0; color:#1E40AF;">Estamos preparando tu kit con mucho cuidado. ¡Pronto estará en camino!</p>
    </div>
    @endif

    @if($order->status === 'shipped')
    <div style="background:#F5F3FF; border-radius:10px; padding:16px; font-size:14px; margin:20px 0; text-align:center;">
      <p style="margin:0 0 8px; color:#5B21B6;">¡Tu pedido está en camino! 🎉</p>
      @if($order->tracking_number)
      <div class="tracking-box">
        <div class="label">Número de guía</div>
        <div class="number">{{ $order->tracking_number }}</div>
      </div>
      <p style="margin:0; font-size:13px; color:#888;">Usa este número para rastrear tu envío con la empresa de transporte.</p>
      @endif
    </div>
    @endif

    @if($order->status === 'delivered')
    <div style="background:#ECFDF5; border-radius:10px; padding:16px; font-size:14px; margin:20px 0; text-align:center;">
      <p style="margin:0; color:#065F46;">¡Tu pedido ha sido entregado! Esperamos que disfrutes creando tu joya especial. 💛</p>
    </div>
    <div style="text-align:center; margin-top:16px;">
      <a href="{{ route('instrucciones') }}" style="display:inline-block; background:#C9A96E; color:#fff; padding:12px 24px; border-radius:50px; text-decoration:none; font-weight:bold; font-size:14px;">Ver instrucciones del kit</a>
    </div>
    @endif

    <div style="border-top: 1px solid #F2EDE6; margin-top:24px; padding-top:16px;">
      <p style="font-size:12px; color:#888; margin:0;">Pedido: <strong>{{ $order->order_number }}</strong> · Total: <strong>${{ number_format($order->total, 2) }}</strong></p>
    </div>
  </div>
  <div class="footer">
    <p>Un Tesoro Para Mamá · {{ $order->customer_email }}</p>
  </div>
</div>
</body>
</html>
