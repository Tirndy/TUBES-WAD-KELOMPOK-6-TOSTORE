<?php

namespace App\Http\Controllers;

use App\Models\AlamatPengiriman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlamatPengirimanController extends Controller
{
    // Menampilkan semua alamat
    public function index()
    {
        $alamats = Auth::user()->alamatPengirimans()->get();

        return view('alamat.index', compact('alamats'));
    }

    // Menyimpan alamat baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:50',
            'nama_penerima' => 'required|string|max:100',
            'telepon_penerima' => 'required|string|max:20',
            'alamat_lengkap' => 'required|string',
            'kota' => 'required|string|max:100',
            'provinsi' => 'required|string|max:100',
            'kode_pos' => 'required|string|max:10',
        ]);

        $user = Auth::user();

        $validated['is_default'] = !$user->alamatPengirimans()->exists();

        $user->alamatPengirimans()->create($validated);

        return redirect()->route('alamat.index')
            ->with('success', 'Alamat berhasil ditambahkan!');
    }

    // Mengubah alamat
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:50',
            'nama_penerima' => 'required|string|max:100',
            'telepon_penerima' => 'required|string|max:20',
            'alamat_lengkap' => 'required|string',
            'kota' => 'required|string|max:100',
            'provinsi' => 'required|string|max:100',
            'kode_pos' => 'required|string|max:10',
        ]);

        $alamat = Auth::user()->alamatPengirimans()->findOrFail($id);
        $alamat->update($validated);

        return redirect()->route('alamat.index')
            ->with('success', 'Alamat berhasil diperbarui!');
    }

    // Menghapus alamat
    public function destroy($id)
    {
        $alamat = Auth::user()->alamatPengirimans()->findOrFail($id);
        $alamat->delete();

        return redirect()->route('alamat.index')
            ->with('success', 'Alamat berhasil dihapus!');
    }

    // Menjadikan alamat utama
    public function setDefault($id)
    {
        $user = Auth::user();

        $alamat = $user->alamatPengirimans()->findOrFail($id);

        $user->alamatPengirimans()->update([
            'is_default' => false
        ]);

        $alamat->update([
            'is_default' => true
        ]);

        return redirect()->route('alamat.index')
            ->with('success', 'Alamat utama berhasil diubah!');
    }
}