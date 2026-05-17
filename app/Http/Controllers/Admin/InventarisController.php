<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventaris;
use App\Http\Requests\InventarisRequest;

class InventarisController extends Controller
{
    /**
     * Generate kode barang otomatis format INV-0001
     */
    private function generateKode(): string
    {
        $last = Inventaris::orderBy('id_inventaris', 'desc')->first();
        $number = $last ? ($last->id_inventaris + 1) : 1;
        return 'INV-' . str_pad($number, 4, '0', STR_PAD_LEFT);
    }

    public function index(Request $request)
    {
        $kategoriOptions = ['Elektronik', 'Furnitur', 'Perlengkapan'];
        $query = Inventaris::query()->orderBy('created_at', 'desc');

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($builder) use ($search) {
                $builder->where('kode_barang', 'like', "%{$search}%")
                    ->orWhere('nama_barang', 'like', "%{$search}%");
            });
        }

        if ($request->filled('kategori') && in_array($request->kategori, $kategoriOptions, true)) {
            $elektronikKeywords = ['proyektor', 'laptop', 'speaker', 'sound', 'mikrofon', 'kamera', 'kabel'];
            $furniturKeywords = ['kursi', 'meja', 'lemari', 'rak'];

            $keywords = match ($request->kategori) {
                'Elektronik' => $elektronikKeywords,
                'Furnitur' => $furniturKeywords,
                default => [],
            };

            if ($request->kategori === 'Perlengkapan') {
                $query->where(function ($builder) use ($elektronikKeywords, $furniturKeywords) {
                    foreach (array_merge($elektronikKeywords, $furniturKeywords) as $keyword) {
                        $builder->where('nama_barang', 'not like', "%{$keyword}%");
                    }
                });
            } else {
                $query->where(function ($builder) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $builder->orWhere('nama_barang', 'like', "%{$keyword}%");
                    }
                });
            }
        }

        $inventaris = $query->paginate(10)->withQueryString();
        $kodeBaru   = $this->generateKode();

        return view('admin.inventaris.index', compact('inventaris', 'kodeBaru', 'kategoriOptions'));
    }

    public function store(InventarisRequest $request)
    {
        $data = $request->validated();
        $data['kode_barang']      = $this->generateKode();
        $data['jumlah_tersedia']  = $data['jumlah_total'];

        Inventaris::create($data);

        return redirect()->route('admin.inventaris.index')
            ->with('success', 'Inventaris berhasil ditambahkan.');
    }

    public function edit(Inventaris $inventari)
    {
        return view('admin.inventaris.edit', ['inventaris' => $inventari]);
    }

    public function update(InventarisRequest $request, Inventaris $inventari)
    {
        $inventari->update($request->validated());
        return redirect()->route('admin.inventaris.index')
            ->with('success', 'Data inventaris berhasil diperbarui.');
    }

    public function destroy(Inventaris $inventari)
    {
        $inventari->delete();
        return redirect()->route('admin.inventaris.index')
            ->with('success', 'Data inventaris berhasil dihapus.');
    }
}
