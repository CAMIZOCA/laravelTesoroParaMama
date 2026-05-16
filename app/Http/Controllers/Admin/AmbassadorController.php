<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ambassador;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AmbassadorController extends Controller
{
    public function index(Request $request): View
    {
        $query = Ambassador::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $ambassadors = $query->latest()->paginate(20)->withQueryString();

        return view('admin.ambassadors.index', compact('ambassadors'));
    }

    public function create(): View
    {
        return view('admin.ambassadors.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name'           => 'required|string|max:100',
            'last_name'      => 'nullable|string|max:100',
            'email'          => 'nullable|email|max:150',
            'code'           => 'required|string|max:50|unique:ambassadors,code',
            'discount_type'  => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'status'         => 'required|in:active,inactive',
        ]);

        Ambassador::create($data);

        return redirect()->route('admin.ambassadors.index')
            ->with('success', 'Embajadora creada correctamente.');
    }

    public function edit(Ambassador $ambassador): View
    {
        return view('admin.ambassadors.edit', compact('ambassador'));
    }

    public function update(Request $request, Ambassador $ambassador): RedirectResponse
    {
        $data = $request->validate([
            'name'           => 'required|string|max:100',
            'last_name'      => 'nullable|string|max:100',
            'email'          => 'nullable|email|max:150',
            'code'           => 'required|string|max:50|unique:ambassadors,code,' . $ambassador->id,
            'discount_type'  => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'status'         => 'required|in:active,inactive',
        ]);

        $ambassador->update($data);

        return redirect()->route('admin.ambassadors.index')
            ->with('success', 'Embajadora actualizada correctamente.');
    }

    public function destroy(Ambassador $ambassador): RedirectResponse
    {
        if ($ambassador->orders()->exists()) {
            $ambassador->update(['status' => 'inactive']);
            return redirect()->route('admin.ambassadors.index')
                ->with('success', 'La embajadora tiene pedidos asociados, fue desactivada en lugar de eliminada.');
        }

        $ambassador->delete();

        return redirect()->route('admin.ambassadors.index')
            ->with('success', 'Embajadora eliminada correctamente.');
    }
}
