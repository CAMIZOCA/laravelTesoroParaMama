<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ambassador;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AmbassadorController extends Controller
{
    public function index(): View
    {
        $ambassadors = Ambassador::orderBy('name')->get();
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
            'lastname'       => 'nullable|string|max:100',
            'email'          => 'nullable|email|max:150',
            'code'           => 'required|string|max:50|unique:ambassadors,code',
            'discount_type'  => 'required|in:percent,fixed',
            'discount_value' => 'required|numeric|min:0',
            'is_active'      => 'boolean',
            'notes'          => 'nullable|string|max:500',
        ]);

        $data['code']      = strtoupper(trim($data['code']));
        $data['is_active'] = $request->boolean('is_active', true);

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
            'lastname'       => 'nullable|string|max:100',
            'email'          => 'nullable|email|max:150',
            'code'           => 'required|string|max:50|unique:ambassadors,code,' . $ambassador->id,
            'discount_type'  => 'required|in:percent,fixed',
            'discount_value' => 'required|numeric|min:0',
            'is_active'      => 'boolean',
            'notes'          => 'nullable|string|max:500',
        ]);

        $data['code']      = strtoupper(trim($data['code']));
        $data['is_active'] = $request->boolean('is_active');

        $ambassador->update($data);

        return redirect()->route('admin.ambassadors.index')
            ->with('success', 'Embajadora actualizada correctamente.');
    }

    public function toggle(Ambassador $ambassador): RedirectResponse
    {
        $ambassador->update(['is_active' => !$ambassador->is_active]);
        $status = $ambassador->is_active ? 'activada' : 'desactivada';
        return back()->with('success', "Embajadora {$status} correctamente.");
    }

    public function report(Ambassador $ambassador, Request $request): View
    {
        $month = (int) $request->get('month', now()->month);
        $year  = (int) $request->get('year', now()->year);

        $orders = Order::where('ambassador_code', $ambassador->code)
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->with('items')
            ->orderByDesc('created_at')
            ->get();

        $totalSales    = $orders->sum('total');
        $totalOrders   = $orders->count();
        $totalDiscount = $orders->sum(fn($o) => $ambassador->applyDiscount((float) $o->subtotal));

        $months = collect(range(1, 12))->mapWithKeys(fn($m) => [
            $m => \Carbon\Carbon::create(null, $m)->locale('es')->monthName,
        ]);

        return view('admin.ambassadors.report', compact(
            'ambassador', 'orders', 'totalSales', 'totalOrders',
            'totalDiscount', 'month', 'year', 'months'
        ));
    }

    public function destroy(Ambassador $ambassador): RedirectResponse
    {
        $ambassador->delete();
        return redirect()->route('admin.ambassadors.index')
            ->with('success', 'Embajadora eliminada.');
    }
}
