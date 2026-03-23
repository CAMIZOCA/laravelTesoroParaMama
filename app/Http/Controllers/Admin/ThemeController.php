<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ThemeSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ThemeController extends Controller
{
    public function index(): View
    {
        $defaults = ThemeSetting::defaults();
        $saved    = ThemeSetting::all_settings();
        $theme    = array_merge($defaults, $saved);
        $palettes = ThemeSetting::palettes();

        return view('admin.theme.index', compact('theme', 'palettes'));
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->only(array_keys(ThemeSetting::defaults()));

        // Validate hex colors
        foreach ($data as $key => $value) {
            if ($value && !preg_match('/^#[0-9A-Fa-f]{6}$/', $value)) {
                return back()->withErrors(["$key debe ser un color hexadecimal válido (ej: #C9A96E)"]);
            }
        }

        ThemeSetting::saveMany($data);

        return redirect()->route('admin.theme.index')
            ->with('success', 'Colores actualizados correctamente.');
    }

    public function applyPalette(Request $request): RedirectResponse
    {
        $request->validate(['palette' => 'required|string']);
        $palettes = ThemeSetting::palettes();

        if (!isset($palettes[$request->palette])) {
            return back()->withErrors(['Paleta no encontrada.']);
        }

        ThemeSetting::saveMany($palettes[$request->palette]['values']);

        return redirect()->route('admin.theme.index')
            ->with('success', 'Paleta "' . $palettes[$request->palette]['name'] . '" aplicada correctamente.');
    }
}
