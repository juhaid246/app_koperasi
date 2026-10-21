<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PinjamanController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('search');

        $pinjamans = Pinjaman::with(['anggota', 'approver'])
            ->when($keyword, function ($query, $keyword) {
                $query->whereHas('anggota', function ($q) use ($keyword) {
                    $q->where('nama', 'like', "%{$keyword}%")
                      ->orWhere('nik', 'like', "%{$keyword}%");
                });
            })->latest()->paginate(10)->withQueryString();

        return view('pinjaman.index', compact('pinjamans', 'keyword'));
    }

    public function create()
    {
        $anggotas = Anggota::where('status', 'aktif')->orderBy('nama')->get();
        return view('pinjaman.create', compact('anggotas'));
    }

    public function store(Request $request)
    {
        $data = Validator::make($request->all(), [
            'anggota_id' => 'required|exists:anggotas,id',
            'jumlah_pengajuan' => 'required|numeric|min:100000',
            'bunga_persen' => 'required|numeric|min:0|max:100',
            'tenor_bulan' => 'required|integer|min:1|max:120',
        ])->validate();

        $data['status'] = 'pengajuan';

        Pinjaman::create($data);

        return redirect()->route('pinjaman.index')->with('success', 'Pengajuan pinjaman berhasil dibuat.');
    }

    public function edit($id)
    {
        $pinjaman = Pinjaman::findOrFail($id);
        $anggotas = Anggota::where('status', 'aktif')->orderBy('nama')->get();

        return view('pinjaman.edit', compact('pinjaman', 'anggotas'));
    }

    public function update(Request $request, $id)
    {
        $pinjaman = Pinjaman::findOrFail($id);

        $data = Validator::make($request->all(), [
            'anggota_id' => 'required|exists:anggotas,id',
            'jumlah_pengajuan' => 'required|numeric|min:100000',
            'jumlah_disetujui' => 'nullable|numeric|min:0',
            'bunga_persen' => 'required|numeric|min:0|max:100',
            'tenor_bulan' => 'required|integer|min:1|max:120',
            'status' => 'required|in:pengajuan,disetujui,ditolak,lunas',
        ])->validate();

        if (in_array($data['status'], ['disetujui', 'ditolak'])) {
            $data['approved_by'] = auth()->id();
            if ($data['status'] === 'disetujui' && empty($data['jumlah_disetujui'])) {
                $data['jumlah_disetujui'] = $data['jumlah_pengajuan'];
            }
        }

        $pinjaman->update($data);

        return redirect()->route('pinjaman.index')->with('success', 'Data pinjaman berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pinjaman = Pinjaman::findOrFail($id);
        $pinjaman->delete();

        return redirect()->route('pinjaman.index')->with('success', 'Data pinjaman berhasil dihapus.');
    }
}