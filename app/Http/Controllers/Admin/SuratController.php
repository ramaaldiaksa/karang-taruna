<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Surat;
use App\Http\Requests\SuratRequest;
use Illuminate\Support\Facades\Storage;

class SuratController extends Controller
{
    public function index(Request $request)
    {
        $query = Surat::with('admin')->orderBy('tanggal_upload', 'desc');

        if ($request->filled('q')) {
            $query->where('judul', 'like', "%{$request->q}%");
        }

        if ($request->filled('jenis_surat')) {
            $query->where('jenis_surat', $request->jenis_surat);
        }

        $surats = $query->paginate(10)->withQueryString();
        $totalSuratMasuk = Surat::where('jenis_surat', 'surat masuk')->count();
        $totalSuratKeluar = Surat::where('jenis_surat', 'surat keluar')->count();

        return view('admin.surat.index', compact('surats', 'totalSuratMasuk', 'totalSuratKeluar'));
    }

    public function store(SuratRequest $request)
    {
        $data = $request->validated();
        $data['id_admin'] = auth()->id();
        
        if ($request->hasFile('file_surat')) {
            $data['file_surat'] = $request->file('file_surat')->store('arsip_surat', 'public');
        }

        Surat::create($data);
        return redirect()->route('admin.surat.index')->with('success', 'Surat berhasil diarsipkan.');
    }

    public function destroy(Surat $surat)
    {
        if ($surat->file_surat && Storage::disk('public')->exists($surat->file_surat)) {
            Storage::disk('public')->delete($surat->file_surat);
        }

        $surat->delete();
        return redirect()->route('admin.surat.index')->with('success', 'Arsip surat berhasil dihapus.');
    }
}
