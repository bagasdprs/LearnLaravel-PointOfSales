<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BelajarController extends Controller
{
    public function index()
    {
        return view('belajar');
    }

    public function tambah()
    {
        $jumlah = 0;
        return view('tambah', compact('jumlah'));
    }

    public function actionTambah(Request $request)
    {
        $angka1 = $request->angka1;
        $angka2 = $request->angka2;
        $jumlah = $angka1 + $angka2;
        return view('tambah', compact('jumlah'));
    }

    public function kurang()
    {
        return view('kurang');
    }

    public function bagi()
    {
        return view('bagi');
    }
    public function kali()
    {
        return view('kali');
    }
}
