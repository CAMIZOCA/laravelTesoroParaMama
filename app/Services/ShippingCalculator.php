<?php

namespace App\Services;

use App\Models\PageContent;

class ShippingCalculator
{
    private static array $quitoKeywords = [
        'quito', 'norte de quito', 'sur de quito', 'cumbaya', 'tumbaco',
        'sangolqui', 'sangolquí', 'rumiñahui', 'ruminahui', 'conocoto',
        'chillogallo', 'carapungo',
    ];

    private static array $galapagosCities = ['galápagos', 'galapagos', 'santa cruz', 'san cristóbal', 'san cristobal', 'isabela'];

    public function calculate(string $city, string $country = 'Ecuador'): array
    {
        $city    = strtolower(trim($city));
        $country = strtolower(trim($country));

        if ($country !== 'ecuador') {
            return [
                'amount'  => null,
                'label'   => 'Consultar',
                'message' => PageContent::get('shipping_international', 'Para envíos internacionales, escríbenos por WhatsApp.'),
            ];
        }

        foreach (self::$galapagosCities as $keyword) {
            if (str_contains($city, $keyword)) {
                return [
                    'amount'  => null,
                    'label'   => 'Consultar',
                    'message' => PageContent::get('shipping_galapagos', 'Para Galápagos, escríbenos por WhatsApp.'),
                ];
            }
        }

        foreach (self::$quitoKeywords as $keyword) {
            if (str_contains($city, $keyword)) {
                $cost = (float) PageContent::get('shipping_cost_quito', '0');
                return [
                    'amount'  => $cost,
                    'label'   => $cost === 0.0 ? 'Gratis' : '$' . number_format($cost, 2),
                    'message' => PageContent::get('shipping_quito', 'Envío gratis dentro de Quito.'),
                ];
            }
        }

        $cost = (float) PageContent::get('shipping_cost_provinces', '5');
        return [
            'amount'  => $cost,
            'label'   => '$' . number_format($cost, 2),
            'message' => PageContent::get('shipping_provinces', 'Envío a provincias del Ecuador: $5.'),
        ];
    }
}
