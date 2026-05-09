<?php

namespace App\Services;

use App\Models\Ambassador;

class AmbassadorDiscountService
{
    public function validate(string $code): array
    {
        $code       = strtoupper(trim($code));
        $ambassador = Ambassador::where('code', $code)->first();

        if (!$ambassador) {
            return ['valid' => false, 'message' => 'Código no válido.'];
        }

        if (!$ambassador->is_active) {
            return ['valid' => false, 'message' => 'Este código no está activo.'];
        }

        $label = $ambassador->discount_type === 'percent'
            ? $ambassador->discount_value . '% de descuento'
            : '$' . number_format($ambassador->discount_value, 2) . ' de descuento';

        return [
            'valid'          => true,
            'ambassador_id'  => $ambassador->id,
            'ambassador_name' => $ambassador->fullName(),
            'discount_type'  => $ambassador->discount_type,
            'discount_value' => (float) $ambassador->discount_value,
            'label'          => $label,
            'message'        => '¡Código válido! ' . $label . ' aplicado.',
        ];
    }

    public function calculateDiscount(string $code, float $subtotal): float
    {
        $ambassador = Ambassador::where('code', strtoupper($code))->active()->first();
        if (!$ambassador) return 0.0;
        return $ambassador->applyDiscount($subtotal);
    }
}
