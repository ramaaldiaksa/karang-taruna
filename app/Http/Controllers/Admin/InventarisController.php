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
        $statusOptions = ['lengkap', 'tersedia', 'habis'];
        $query = Inventaris::query()->orderBy('created_at', 'desc');

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($builder) use ($search) {
                $builder->where('kode_barang', 'like', "%{$search}%")
                    ->orWhere('nama_barang', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status') && in_array($request->status, $statusOptions, true)) {
            $query->where(function ($builder) use ($request) {
                if ($request->status === 'habis') {
                    $builder->whereRaw('jumlah_tersedia = 0');
                } elseif ($request->status === 'tersedia') {
                    $builder->whereRaw('jumlah_tersedia > 0')
                        ->whereRaw('jumlah_tersedia < jumlah_total');
                } elseif ($request->status === 'lengkap') {
                    $builder->whereRaw('jumlah_tersedia = jumlah_total');
                }
            });
        }

        $inventaris = $query->paginate(10)->withQueryString();
        $kodeBaru = $this->generateKode();
        $totalBarang = (int) Inventaris::sum('jumlah_total');
        $stokMenipis = Inventaris::where('jumlah_tersedia', '<=', 1)->count();
        $stokMenipisItem = Inventaris::where('jumlah_tersedia', '<=', 1)
            ->orderBy('jumlah_tersedia', 'asc')
            ->orderBy('created_at', 'desc')
            ->first();
        $aktivitasTerkini = Inventaris::orderBy('created_at', 'desc')->limit(2)->get();

        return view('admin.inventaris.index', compact(
            'inventaris',
            'kodeBaru',
            'statusOptions',
            'totalBarang',
            'stokMenipis',
            'stokMenipisItem',
            'aktivitasTerkini'
        ));
    }

    public function store(InventarisRequest $request)
    {
        $data = $request->validated();
        $normalizedName = mb_strtolower(trim($data['nama_barang']));

        $existingItem = Inventaris::whereRaw('LOWER(nama_barang) = ?', [$normalizedName])->first();

        if ($existingItem) {
            $existingItem->increment('jumlah_total', (int) $data['jumlah_total']);
            $existingItem->increment('jumlah_tersedia', (int) $data['jumlah_total']);
            $existingItem->tanggal_masuk = $data['tanggal_masuk'];
            $existingItem->save();

            return redirect()->route('admin.inventaris.index')
                ->with('success', 'Stok inventaris berhasil ditambahkan ke item yang sudah ada.');
        }

        $data['kode_barang'] = $this->generateKode();
        $data['jumlah_tersedia'] = $data['jumlah_total'];

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
        $data = $request->validated();
        $diff = (int) $data['jumlah_total'] - (int) $inventari->jumlah_total;

        if ($inventari->jumlah_tersedia + $diff < 0) {
            return back()->with('error', 'Jumlah total tidak bisa dikurangi sebanyak itu karena barang sedang dipinjam.');
        }

        $data['jumlah_tersedia'] = $inventari->jumlah_tersedia + $diff;

        $inventari->update($data);
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
