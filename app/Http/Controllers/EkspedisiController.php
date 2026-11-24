<?php
namespace App\Http\Controllers;

use App\Models\Ekspedisi;
use Illuminate\Http\Request;

class EkspedisiController extends Controller
{
    private $layananList = ['Reguler', 'Express'];

    private $zonaList = ['Jawa', 'Bali', 'Luar Jawa'];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ekspedisis = Ekspedisi::latest()->paginate(10);

        return view('admin.ekspedisi.index', compact('ekspedisis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ekspedisi.create', [
            'layananList' => $this->layananList,
            'zonaList' => $this->zonaList,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ekspedisi = Ekspedisi::findOrFail($id);

        return view('admin.ekspedisi.show', compact('ekspedisi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ekspedisi = Ekspedisi::findOrFail($id);

        return view('admin.ekspedisi.edit', [
            'ekspedisi' => $ekspedisi,
            'layananList' => $this->layananList,
            'zonaList' => $this->zonaList,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ekspedisi = Ekspedisi::findOrFail($id);
        $ekspedisi->delete();

        return redirect()->route('ekspedisi.index')
            ->with('success', 'Data ekspedisi berhasil dihapus.');
    }
}
