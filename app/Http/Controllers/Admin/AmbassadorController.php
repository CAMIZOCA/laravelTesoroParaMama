<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ambassador;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

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

    public function exportCsv(): StreamedResponse
    {
        $ambassadors = Ambassador::orderBy('name')->get();
        $filename = 'embajadoras_' . now()->format('Y-m-d') . '.csv';

        return response()->streamDownload(function () use ($ambassadors) {
            $handle = fopen('php://output', 'w');
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF)); // BOM UTF-8
            fputcsv($handle, ['name', 'last_name', 'email', 'code', 'discount_type', 'discount_value', 'status']);

            foreach ($ambassadors as $a) {
                fputcsv($handle, [
                    $a->name,
                    $a->last_name,
                    $a->email,
                    $a->code,
                    $a->discount_type,
                    $a->discount_value,
                    $a->status,
                ]);
            }

            fclose($handle);
        }, $filename, ['Content-Type' => 'text/csv; charset=UTF-8']);
    }

    public function importCsv(Request $request): RedirectResponse
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ], [
            'csv_file.required' => 'Debes seleccionar un archivo CSV.',
            'csv_file.mimes'    => 'El archivo debe ser de tipo CSV.',
            'csv_file.max'      => 'El archivo no puede superar los 2 MB.',
        ]);

        $path = $request->file('csv_file')->getRealPath();
        $handle = fopen($path, 'r');

        // Strip BOM if present
        $bom = fread($handle, 3);
        if ($bom !== chr(0xEF) . chr(0xBB) . chr(0xBF)) {
            rewind($handle);
        }

        $header = fgetcsv($handle); // skip header row

        $imported  = 0;
        $skipped   = [];
        $errors    = [];
        $rowNumber = 1;

        $existingCodes = Ambassador::pluck('code')->map(fn($c) => strtoupper(trim($c)))->flip()->toArray();

        while (($row = fgetcsv($handle)) !== false) {
            $rowNumber++;

            if (count(array_filter($row)) === 0) {
                continue; // skip blank lines
            }

            [$name, $last_name, $email, $code, $discount_type, $discount_value, $status] = array_pad($row, 7, '');

            $name          = trim($name);
            $last_name     = trim($last_name);
            $email         = trim($email);
            $code          = strtoupper(trim($code));
            $discount_type = trim($discount_type);
            $discount_value = trim($discount_value);
            $status        = trim($status);

            // Required fields
            if ($name === '' || $code === '') {
                $errors[] = "Fila {$rowNumber}: los campos 'name' y 'code' son obligatorios.";
                continue;
            }

            // Duplicate check
            if (isset($existingCodes[$code])) {
                $skipped[] = $code;
                continue;
            }

            // discount_type
            if (!in_array($discount_type, ['percentage', 'fixed'])) {
                $errors[] = "Fila {$rowNumber} (código {$code}): 'discount_type' debe ser 'percentage' o 'fixed', se recibió '{$discount_type}'.";
                continue;
            }

            // discount_value
            if (!is_numeric($discount_value) || (float) $discount_value < 0) {
                $errors[] = "Fila {$rowNumber} (código {$code}): 'discount_value' debe ser un número mayor o igual a 0.";
                continue;
            }

            // status (default active if invalid)
            if (!in_array($status, ['active', 'inactive'])) {
                $status = 'active';
            }

            Ambassador::create([
                'name'           => $name,
                'last_name'      => $last_name ?: '',
                'email'          => $email ?: null,
                'code'           => $code,
                'discount_type'  => $discount_type,
                'discount_value' => (float) $discount_value,
                'status'         => $status,
            ]);

            $existingCodes[$code] = true;
            $imported++;
        }

        fclose($handle);

        $session = redirect()->route('admin.ambassadors.index');

        if ($imported > 0) {
            $session = $session->with('import_success', "{$imported} embajadora(s) importada(s) correctamente.");
        }

        if (!empty($skipped)) {
            $session = $session->with('import_warning', count($skipped) . ' omitida(s) por código duplicado: ' . implode(', ', $skipped) . '.');
        }

        if (!empty($errors)) {
            $session = $session->with('import_errors', $errors);
        }

        if ($imported === 0 && empty($skipped) && empty($errors)) {
            $session = $session->with('import_warning', 'El archivo CSV estaba vacío o no contenía filas válidas.');
        }

        return $session;
    }
}
