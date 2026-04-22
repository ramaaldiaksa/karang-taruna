<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Berita;

class HomeController extends Controller
{
    public function index()
    {
        $beritas = Berita::where('tanggal_terbit', '<=', now()->toDateString())
                    ->latest('tanggal_terbit')
                    ->take(3)
                    ->get();
                    
        return view('public.home', compact('beritas'));
    }

    public function about()
    {
        return view('public.about');
    }}
