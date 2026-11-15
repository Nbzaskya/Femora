<?php

namespace App\Http\Controllers;

use App\Models\CycleSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CycleSettingController extends Controller
{
    // Menampilkan halaman pengaturan siklus
    public function index()
    {
        $setting = CycleSetting::firstOrCreate(
            ['user_id' => Auth::id()],
            [
                'cycle_length' => null,
                'period_duration' => null,
            ]
        );

        return view('settings.cycle', compact('setting'));
    }

    // Menyimpan perubahan pengaturan siklus
    public function update(Request $request)
    {
        $validated = $request->validate([
            'cycle_length' => 'required|integer|between:15,60',
            'period_duration' => 'required|integer|between:1,15',
        ], [
            'cycle_length.required' => 'Panjang siklus wajib diisi.',
            'cycle_length.between' => 'Panjang siklus harus antara 15 sampai 60 hari.',
            'period_duration.required' => 'Durasi menstruasi wajib diisi.',
            'period_duration.between' => 'Durasi menstruasi harus antara 1 sampai 15 hari.',
        ]);

        CycleSetting::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'cycle_length' => $validated['cycle_length'],
                'period_duration' => $validated['period_duration'],
            ]
        );

        return redirect()
            ->route('settings.cycle')
            ->with('success', 'Pengaturan siklus berhasil diperbarui!');
    }
}