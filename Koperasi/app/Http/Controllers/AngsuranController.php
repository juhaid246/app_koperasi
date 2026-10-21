<?php

namespace App\Http\Controllers;

use App\Models\Angsuran;
use App\Models\Pinjaman;
use Illuminate\Http\Request;

class AngsuranController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('search');

        $angsurans = Angsuran::with(['pinjaman.anggota'])
            ->when($keyword, function ($query, $keyword) {
                $query->whereHas('pinjaman.anggota', function ($q) use ($keyword) {
                    $q->where('nama', 'like', "%{$keyword}%")
                      ->orWhere('nik', 'like', "%{$keyword}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('angsuran.index', compact('angsurans', 'keyword'));
    }

    public function create()
    {
        $pinjamans = Pinjaman::with('anggota')
            ->where('status', 'disetujui')
            ->orderBy('id', 'desc')
            ->get();

        return view('angsuran.create', compact('pinjamans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pinjaman_id'    => 'required|exists:pinjaman,id',
            'angsuran_ke'    => 'required|integer|min:1',
            'jatuh_tempo'    => 'nullable|date',
            'jumlah_tagihan' => 'required|numeric|min:0',
            'jumlah_bayar'   => 'required|numeric|min:0',
            'tanggal_bayar'  => 'required|date',
            'status'         => 'required|in:lunas,sebagian,tertunggak',
        ]);

        Angsuran::create($request->all());

        return redirect()->route('angsuran.index')->with('success', 'Pembayaran angsuran berhasil dicatat.');
    }

    public function edit($id)
    {
        $angsuran = Angsuran::findOrFail($id);
        $pinjamans = Pinjaman::with('anggota')
            ->where('status', 'disetujui')
            ->orderBy('id', 'desc')
            ->get();

        return view('angsuran.edit', compact('angsuran', 'pinjamans'));
    }

    public function update(Request $request, $id)
    {
        $angsuran = Angsuran::findOrFail($id);

        $request->validate([
            'pinjaman_id'    => 'required|exists:pinjaman,id',
            'angsuran_ke'    => 'required|integer|min:1',
            'jatuh_tempo'    => 'nullable|date',
            'jumlah_tagihan' => 'required|numeric|min:0',
            'jumlah_bayar'   => 'required|numeric|min:0',
            'tanggal_bayar'  => 'required|date',
            'status'         => 'required|in:lunas,sebagian,tertunggak',
        ]);

        $angsuran->update($request->all());

        return redirect()->route('angsuran.index')->with('success', 'Data angsuran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $angsuran = Angsuran::findOrFail($id);
        $angsuran->delete();

        return redirect()->route('angsuran.index')->with('success', 'Data angsuran berhasil dihapus.');
    }
}