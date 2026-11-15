<?php

namespace App\Http\Controllers;

use App\Models\DailyLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DailyLogController extends Controller
{
    // Menampilkan seluruh jurnal milik pengguna
    public function index()
    {
        $logs = DailyLog::where('user_id', Auth::id())
            ->orderBy('log_date', 'desc')
            ->paginate(10);

        return view('journal.index', compact('logs'));
    }

    // Menyimpan jurnal baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'log_date' => [
                'required',
                'date',
                'before_or_equal:today',
                Rule::unique('daily_logs', 'log_date')
                    ->where('user_id', Auth::id()),
            ],
            'symptoms' => 'nullable|array',
            'symptoms.*' => 'in:kram perut,sakit kepala,nyeri pinggang,kelelahan,mual,kembung,jerawat,nyeri payudara',
            'mood' => 'nullable|in:Senang,Tenang,Sedih,Mudah marah,Cemas,Lelah',
            'notes' => 'nullable|string|max:2000',
        ], [
            'log_date.before_or_equal' => 'Tanggal jurnal tidak boleh melebihi hari ini.',
            'log_date.unique' => 'Kamu sudah memiliki jurnal pada tanggal tersebut.',
        ]);

        DailyLog::create([
            'user_id' => Auth::id(),
            'log_date' => $validated['log_date'],
            'symptoms' => $validated['symptoms'] ?? [],
            'mood' => $validated['mood'] ?? null,
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()
            ->route('journal.index')
            ->with('success', 'Jurnal harian berhasil ditambahkan!');
    }

    // Menampilkan halaman edit
    public function edit($id)
    {
        $log = DailyLog::where('user_id', Auth::id())
            ->findOrFail($id);

        return view('journal.edit', compact('log'));
    }

    // Memperbarui jurnal
    public function update(Request $request, $id)
    {
        $log = DailyLog::where('user_id', Auth::id())
            ->findOrFail($id);

        $validated = $request->validate([
            'log_date' => [
                'required',
                'date',
                'before_or_equal:today',
                Rule::unique('daily_logs', 'log_date')
                    ->where('user_id', Auth::id())
                    ->ignore($log->id),
            ],
            'symptoms' => 'nullable|array',
            'symptoms.*' => 'in:kram perut,sakit kepala,nyeri pinggang,kelelahan,mual,kembung,jerawat,nyeri payudara',
            'mood' => 'nullable|in:Senang,Tenang,Sedih,Mudah marah,Cemas,Lelah',
            'notes' => 'nullable|string|max:2000',
        ], [
            'log_date.required' => 'Tanggal jurnal wajib diisi.',
            'log_date.date' => 'Format tanggal jurnal tidak valid.',
            'log_date.before_or_equal' => 'Tanggal jurnal tidak boleh melebihi hari ini.',
            'log_date.unique' => 'Kamu sudah memiliki jurnal pada tanggal tersebut.',
        ]);

        $log->update([
            'log_date' => $validated['log_date'],
            'symptoms' => $validated['symptoms'] ?? [],
            'mood' => $validated['mood'] ?? null,
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()
            ->route('journal.index')
            ->with('success', 'Jurnal harian berhasil diperbarui!');
    }

    // Menghapus jurnal
    public function destroy($id)
    {
        $log = DailyLog::where('user_id', Auth::id())
            ->findOrFail($id);

        $log->delete();

        return redirect()
            ->route('journal.index')
            ->with('success', 'Jurnal harian berhasil dihapus!');
    }
}
