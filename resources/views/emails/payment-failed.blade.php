<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>No pudimos procesar tu pago</title>
<style>
  body { font-family: Georgia, serif; background: #FAF7F2; margin: 0; padding: 20px; color: #3D4A35; }
  .container { max-width: 560px; margin: 0 auto; background: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
  .header { background: #2C3628; color: #ffffff; padding: 32px; text-align: center; }
  .header h1 { font-size: 20px; margin: 0 0 4px; }
  .header p { font-size: 13px; margin: 0; color: #C9A96E; }
  .body { padding: 28px; }
  .alert-box { background: #FEF2F2; border: 1px solid #FECACA; border-radius: 12px; padding: 16px; margin: 16px 0; text-align: center; }
  .tips { background: #F2EDE6; border-radius: 10px; padding: 16px; margin: 20px 0; }
  .tip { display: flex; gap: 10px; margin-bottom: 10px; font-size: 14px; }
  .tip:last-child { margin-bottom: 0; }
  .tip-icon { color: #C9A96E; flex-shrink: 0; }
  .cta-btn { display: inline-block; background: #C9A96E; color: #ffffff; padding: 13px 28px; border-radius: 50px; text-decoration: none; font-weight: bold; font-size: 14px; }
  .footer { background: #F2EDE6; padding: 16px 28px; text-align: center; font-size: 12px; color: #888; }
</style>
</head>
<body>
<div class="container">
  <div class="header">
    <h1>No pudimos procesar tu pago</h1>
    <p>Un Tesoro Para Mamá</p>
  </div>
  <div class="body">
    <p style="font-size:15px;">Hola <strong>{{ $order->customer_name ?? 'estimada clienta' }}</strong>,</p>

    <div class="alert-box">
      <p style="font-size:14px; color:#B91C1C; margin:0;">Tu tarjeta no fue cobrada. Hubo un problema al procesar el pago para tu pedido.</p>
    </div>

    <p style="font-size:14px;">No te preocupes, esto pasa a veces. Aquí te dejamos algunos pasos para resolverlo:</p>

    <div class="tips">
      <div class="tip"><span class="tip-icon">✓</span><span>Verifica que el número de tarjeta, fecha de vencimiento y CVV sean correctos.</span></div>
      <div class="tip"><span class="tip-icon">✓</span><span>Confirma con tu banco que la tarjeta esté habilitada para compras internacionales.</span></div>
      <div class="tip"><span class="tip-icon">✓</span><span>Asegúrate de tener fondos suficientes disponibles.</span></div>
      <div class="tip"><span class="tip-icon">✓</span><span>Intenta con otra tarjeta si tienes una disponible.</span></div>
    </div>

    <div style="text-align:center; margin:24px 0;">
      <a href="{{ route('checkout') }}" class="cta-btn">Intentar el pago nuevamente</a>
    </div>

    <p style="font-size:13px; color:#888; text-align:center;">¿Necesitas ayuda? Contáctanos y te asistimos con gusto. 💬</p>
  </div>
  <div class="footer">
    <p>Un Tesoro Para Mamá · Kits DIY de joyería de leche materna</p>
  </div>
</div>
</body>
</html>
