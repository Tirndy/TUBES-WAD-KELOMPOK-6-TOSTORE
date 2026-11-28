<?php
namespace App\Http\Controllers;

use App\Models\Ekspedisi;
use Illuminate\Http\Request;

class EkspedisiController extends Controller
{
    private $layananList = ['Reguler', 'Express'];

    private $zonaList = ['Jawa', 'Bali', 'Luar Jawa'];

    
    public function index()
    {
        $ekspedisis = Ekspedisi::latest()->paginate(10);

        return view('admin.ekspedisi.index', compact('ekspedisis'));
    }

   
    public function create()
    {
        return view('admin.ekspedisi.create', [
            'layananList' => $this->layananList,
            'zonaList' => $this->zonaList,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_ekspedisi' => 'required|string|max:100',
            'layanan' => 'required|in:Reguler,Express',
            'zona' => 'required|in:Jawa,Bali,Luar Jawa',
            'tarif' => 'required|integer|min:0',
            'estimasi' => 'required|string|max:50',
        ]);

        Ekspedisi::create($validated);

        return redirect()->route('ekspedisi.index')
            ->with('success', 'Data ekspedisi berhasil ditambahkan.');
    }

    
    public function show(string $id)
    {
        $ekspedisi = Ekspedisi::findOrFail($id);

        return view('admin.ekspedisi.show', compact('ekspedisi'));
    }

    
    public function edit(string $id)
    {
        $ekspedisi = Ekspedisi::findOrFail($id);

        return view('admin.ekspedisi.edit', [
            'ekspedisi' => $ekspedisi,
            'layananList' => $this->layananList,
            'zonaList' => $this->zonaList,
        ]);
    }

    
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama_ekspedisi' => 'required|string|max:100',
            'layanan' => 'required|in:Reguler,Express',
            'zona' => 'required|in:Jawa,Bali,Luar Jawa',
            'tarif' => 'required|integer|min:0',
            'estimasi' => 'required|string|max:50',
        ]);

        $ekspedisi = Ekspedisi::findOrFail($id);
        $ekspedisi->update($validated);

        return redirect()->route('ekspedisi.index')
            ->with('success', 'Data ekspedisi berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $ekspedisi = Ekspedisi::findOrFail($id);
        $ekspedisi->delete();

        return redirect()->route('ekspedisi.index')
            ->with('success', 'Data ekspedisi berhasil dihapus.');
    }
}
