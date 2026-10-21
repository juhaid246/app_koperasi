<?php

namespace App\Http\Controllers;

use App\Models\Simpanan;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SimpananController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('search');

        $simpanans = Simpanan::with('anggota')
            ->when($keyword, function ($query, $keyword) {
                $query->whereHas('anggota', function ($q) use ($keyword) {
                    $q->where('nama', 'like', "%{$keyword}%")
                      ->orWhere('nik', 'like', "%{$keyword}%");
                });
            })->latest()->paginate(10)->withQueryString();

        return view('simpanan.index', compact('simpanans', 'keyword'));
    }

    public function create()
    {
        $anggotas = Anggota::where('status', 'aktif')->orderBy('nama')->get();
        return view('simpanan.create', compact('anggotas'));
    }

    public function store(Request $request)
    {
        $data = Validator::make($request->all(), [
            'anggota_id' => 'required|exists:anggotas,id',
            'tanggal_simpan' => 'required|date',
            'jumlah_simpanan' => 'required|numeric|min:1000',
            'jenis_simpanan' => 'required|in:pokok,wajib,sukarela',
        ])->validate();

        Simpanan::create($data);

        return redirect()->route('simpanan.index')->with('success', 'Data simpanan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $simpanan = Simpanan::findOrFail($id);
        $anggotas = Anggota::where('status', 'aktif')->orderBy('nama')->get();

        return view('simpanan.edit', compact('simpanan', 'anggotas'));
    }

    public function update(Request $request, $id)
    {
        $simpanan = Simpanan::findOrFail($id);

        $data = Validator::make($request->all(), [
            'anggota_id' => 'required|exists:anggotas,id',
            'tanggal_simpan' => 'required|date',
            'jumlah_simpanan' => 'required|numeric|min:1000',
            'jenis_simpanan' => 'required|in:pokok,wajib,sukarela',
        ])->validate();

        $simpanan->update($data);

        return redirect()->route('simpanan.index')->with('success', 'Data simpanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $simpanan = Simpanan::findOrFail($id);
        $simpanan->delete();

        return redirect()->route('simpanan.index')->with('success', 'Data simpanan berhasil dihapus.');
    }
}