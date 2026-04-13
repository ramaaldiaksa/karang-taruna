<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Surat;
use App\Http\Requests\SuratRequest;

class SuratController extends Controller
{
    public function index()
    {
        $surats = Surat::with('admin')->orderBy('tanggal_upload', 'desc')->get();
        $totalSuratMasuk = $surats->where('jenis_surat', 'surat masuk')->count();
        $totalSuratKeluar = $surats->where('jenis_surat', 'surat keluar')->count();

        return view('admin.surat.index', compact('surats', 'totalSuratMasuk', 'totalSuratKeluar'));
    }

    public function create()
    {
        return view('admin.surat.create');
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
        $surat->delete();
        return redirect()->route('admin.surat.index')->with('success', 'Arsip surat berhasil dihapus.');
    }
}
