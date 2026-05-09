<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Nueva venta con tu código!</title>
    <style>
        body { font-family: Georgia, serif; background: #f9f9f9; margin: 0; padding: 0; color: #333; }
        .wrapper { max-width: 600px; margin: 0 auto; background: #fff; }
        .header { background: #111; padding: 32px 40px; text-align: center; }
        .header h1 { color: #fff; font-size: 22px; margin: 0; letter-spacing: 1px; }
        .header p { color: #aaa; font-size: 13px; margin: 6px 0 0; }
        .body { padding: 36px 40px; }
        .body h2 { font-size: 20px; margin: 0 0 8px; color: #111; }
        .body p { line-height: 1.7; margin: 0 0 16px; color: #555; }
        .highlight { background: #fff5f5; border-left: 3px solid #DC2626; padding: 14px 18px; border-radius: 4px; margin: 20px 0; }
        .highlight p { margin: 0; }
        .stat { display: inline-block; background: #f3f4f6; border-radius: 6px; padding: 12px 20px; margin: 4px; text-align: center; }
        .stat strong { display: block; font-size: 22px; color: #DC2626; }
        .stat span { font-size: 12px; color: #888; }
        .stats-row { text-align: center; margin: 24px 0; }
        table.order-detail { width: 100%; border-collapse: collapse; margin: 20px 0; font-size: 14px; }
        table.order-detail th { text-align: left; padding: 8px 12px; background: #f9f9f9; color: #888; font-weight: normal; border-bottom: 1px solid #eee; }
        table.order-detail td { padding: 8px 12px; border-bottom: 1px solid #f3f4f6; }
        .footer { background: #f9f9f9; padding: 20px 40px; text-align: center; font-size: 12px; color: #aaa; border-top: 1px solid #eee; }
        .footer a { color: #888; }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="header">
        <h1>Un Tesoro Para Mamá</h1>
        <p>Notificación de venta para embajadoras</p>
    </div>

    <div class="body">
        <h2>¡Hola, {{ $ambassador->name }}! 🎉</h2>
        <p>
            Alguien usó tu código <strong>{{ $order->ambassador_code }}</strong> y acaba de realizar
            una compra en <em>Un Tesoro Para Mamá</em>. Gracias por seguir compartiendo nuestra misión.
        </p>

        <div class="stats-row">
            <div class="stat">
                <strong>${{ number_format($order->total, 2) }}</strong>
                <span>Total del pedido</span>
            </div>
            <div class="stat">
                <strong>
                    @if($ambassador->discount_type === 'percent')
                        {{ $ambassador->discount_value }}%
                    @else
                        ${{ number_format($ambassador->discount_value, 2) }}
                    @endif
                </strong>
                <span>Descuento aplicado</span>
            </div>
        </div>

        <div class="highlight">
            <p><strong>Pedido #{{ $order->id }}</strong> &mdash; {{ $order->created_at->format('d/m/Y H:i') }}</p>
        </div>

        <table class="order-detail">
            <tr>
                <th>Cliente</th>
                <td>{{ $order->customer_name }} {{ $order->customer_lastname }}</td>
            </tr>
            <tr>
                <th>Ciudad</th>
                <td>{{ $order->city }}, {{ $order->country }}</td>
            </tr>
            <tr>
                <th>Código usado</th>
                <td><strong>{{ $order->ambassador_code }}</strong></td>
            </tr>
            <tr>
                <th>Total pagado</th>
                <td><strong>${{ number_format($order->total, 2) }}</strong></td>
            </tr>
        </table>

        <p style="color:#aaa; font-size:13px;">
            Puedes ver el historial completo de ventas con tu código iniciando sesión en el panel administrativo.
        </p>
    </div>

    <div class="footer">
        <p>Este correo fue enviado automáticamente por <a href="#">Un Tesoro Para Mamá</a>.</p>
        <p>Si tienes dudas, responde a este correo o escríbenos directamente.</p>
    </div>
</div>
</body>
</html>
