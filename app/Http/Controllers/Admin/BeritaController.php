<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::query()
            ->when(request('q'), function ($query, $search) {
                $query->where(function ($builder) use ($search) {
                    $builder->where('judul', 'like', "%{$search}%")
                        ->orWhere('penulis', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'isi' => 'required',
            'tanggal_terbit' => 'required|date',
            'penulis' => 'required|string|max:255',
        ]);

        $data = $request->except('gambar');
        $data['slug'] = Str::slug($request->judul) . '-' . time();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        Berita::create($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan');
    }

    public function edit(Berita $beritum)
    {
        // Parameter binding expects $beritum because resource is singularize by default (if route is berita)
        // Let's explicitly rename variable to $berita in the route or just use the parameter name Laravel expects.
        // Or we can just use the standard parameter name $berita by renaming it in web.php, but let's stick to conventional `$berita`
        return view('admin.berita.edit', ['berita' => $beritum]);
    }

    public function update(Request $request, Berita $beritum)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'isi' => 'required',
            'tanggal_terbit' => 'required|date',
            'penulis' => 'required|string|max:255',
        ]);

        $data = $request->except('gambar');
        
        if ($request->judul !== $beritum->judul) {
            $data['slug'] = Str::slug($request->judul) . '-' . time();
        }

        if ($request->hasFile('gambar')) {
            if ($beritum->gambar && Storage::disk('public')->exists($beritum->gambar)) {
                Storage::disk('public')->delete($beritum->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        $beritum->update($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy(Berita $beritum)
    {
        if ($beritum->gambar && Storage::disk('public')->exists($beritum->gambar)) {
            Storage::disk('public')->delete($beritum->gambar);
        }
        
        $beritum->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus');
    }
}
