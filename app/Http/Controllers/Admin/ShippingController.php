<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShippingController extends Controller
{
    private array $fields = [
        'whatsapp_number',
        'shipping_cost_quito',
        'shipping_cost_provinces',
        'shipping_quito',
        'shipping_provinces',
        'shipping_galapagos',
        'shipping_international',
    ];

    public function index(): View
    {
        $defaults = [
            'whatsapp_number'          => '',
            'shipping_cost_quito'      => '0',
            'shipping_cost_provinces'  => '5',
            'shipping_quito'           => 'Envío gratis dentro de Quito.',
            'shipping_provinces'       => 'Envío a provincias del Ecuador: $5.',
            'shipping_galapagos'       => 'Para Galápagos, escríbenos por WhatsApp.',
            'shipping_international'   => 'Para envíos internacionales, escríbenos por WhatsApp.',
        ];

        $saved    = PageContent::all_settings();
        $settings = array_merge($defaults, array_intersect_key($saved, array_flip($this->fields)));

        return view('admin.shipping.index', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'whatsapp_number'         => 'nullable|string|max:30',
            'shipping_cost_quito'     => 'required|numeric|min:0',
            'shipping_cost_provinces' => 'required|numeric|min:0',
            'shipping_quito'          => 'required|string|max:300',
            'shipping_provinces'      => 'required|string|max:300',
            'shipping_galapagos'      => 'required|string|max:300',
            'shipping_international'  => 'required|string|max:300',
        ]);

        PageContent::saveMany($data);

        return back()->with('success', 'Configuración de envíos guardada correctamente.');
    }
}
