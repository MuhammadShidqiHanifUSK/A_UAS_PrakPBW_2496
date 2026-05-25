<?php

namespace App\Http\Controllers;

use App\Models\Setoran;
use Illuminate\Http\Request;

class SantriController extends Controller
{
    // Tampilkan riwayat setoran santri yang sedang login
    public function index()
    {
        $setorans = Setoran::with(['sabaq.surah', 'sabqi.surah', 'manzil.surah'])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('santri.index', compact('setorans'));
    }

    // Tampilkan detail setoran santri
    public function show($id)
    {
        $setoran = Setoran::with(['user', 'sabaq.surah', 'sabqi.surah', 'manzil.surah', 'catatanSetoran.user'])
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view('santri.show', compact('setoran'));
    }
}