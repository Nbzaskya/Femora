<?php

namespace App\Http\Controllers;

use App\Models\MenstrualCycle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenstrualCycleController extends Controller
{
    // Menampilkan daftar catatan menstruasi dengan filter
    public function index(Request $request)
    {
        // Validasi filter bulan dan tahun
        $validated = $request->validate([
            'month' => 'nullable|integer|between:1,12',
            'year' => 'nullable|integer|digits:4',
        ]);

        // Mengambil daftar tahun dari catatan pengguna
        $years = MenstrualCycle::where('user_id', Auth::id())
            ->selectRaw('YEAR(start_date) as year')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year');

        // Query dasar: hanya catatan pengguna yang login
        $query = MenstrualCycle::where('user_id', Auth::id());

        // Filter berdasarkan bulan
        if (!empty($validated['month'])) {
            $query->whereMonth('start_date', $validated['month']);
        }

        // Filter berdasarkan tahun
        if (!empty($validated['year'])) {
            $query->whereYear('start_date', $validated['year']);
        }

        // Mengambil hasil filter
        $cycles = $query
            ->orderBy('start_date', 'desc')
            ->get();

        return view('menstrual.index', compact(
            'cycles',
            'years',
            'validated'
        ));
    }

    // Menyimpan catatan menstruasi baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'required|date|before_or_equal:today',
            'end_date' => 'nullable|date|after_or_equal:start_date|before_or_equal:today',
            'notes' => 'nullable|string|max:1000',
        ]);

        // Cegah tanggal mulai yang sama atau rentang menstruasi bertumpuk
        $overlap = MenstrualCycle::where('user_id', Auth::id())
            ->whereDate('start_date', '<=', $validated['end_date'] ?? $validated['start_date'])
            ->where(function ($query) use ($validated) {
                $query->whereNull('end_date')
                    ->orWhereDate('end_date', '>=', $validated['start_date']);
            })
            ->exists();

        if ($overlap) {
            return back()
                ->withErrors([
                    'start_date' => 'Catatan menstruasi bertumpuk dengan catatan sebelumnya.',
                ])
                ->withInput();
        }

        MenstrualCycle::create([
            'user_id' => Auth::id(),
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'] ?? null,
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()
            ->route('menstrual.index')
            ->with('success', 'Catatan menstruasi berhasil disimpan!');
    }


    // Menampilkan halaman edit
    public function edit($id)
    {
        $cycle = MenstrualCycle::where('user_id', Auth::id())
            ->findOrFail($id);

        return view('menstrual.edit', compact('cycle'));
    }

    // Memperbarui catatan menstruasi
    public function update(Request $request, $id)
    {
        $cycle = MenstrualCycle::where('user_id', Auth::id())
            ->findOrFail($id);

        $validated = $request->validate([
            'start_date' => 'required|date|before_or_equal:today',
            'end_date' => 'nullable|date|after_or_equal:start_date|before_or_equal:today',
            'notes' => 'nullable|string|max:1000',
        ]);

        $endDate = $validated['end_date'] ?? $validated['start_date'];

        $overlap = MenstrualCycle::where('user_id', Auth::id())
            ->where('id', '!=', $cycle->id)
            ->whereDate('start_date', '<=', $endDate)
            ->where(function ($query) use ($validated) {
                $query->whereNull('end_date')
                    ->orWhereDate('end_date', '>=', $validated['start_date']);
            })
            ->exists();

        if ($overlap) {
            return back()
                ->withErrors([
                    'start_date' => 'Tanggal menstruasi bertumpuk dengan catatan lain.',
                ])
                ->withInput();
        }

        $cycle->update($validated);

        return redirect()
            ->route('menstrual.index')
            ->with('success', 'Catatan menstruasi berhasil diperbarui!');
    }

    // Menghapus catatan menstruasi
    public function destroy($id)
    {
        $cycle = MenstrualCycle::where('user_id', Auth::id())
            ->findOrFail($id);

        $cycle->delete();

        return redirect()
            ->route('menstrual.index')
            ->with('success', 'Catatan menstruasi berhasil dihapus!');
    }

}
