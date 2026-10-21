<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('search');

        $anggotas = Anggota::when($keyword, function ($query, $keyword) {
            $query->where('nama', 'like', "%{$keyword}%")
                  ->orWhere('nik', 'like', "%{$keyword}%");
        })->latest()->paginate(10)->withQueryString();

        return view('anggota.index', compact('anggotas', 'keyword'));
    }

    public function create()
    {
        return view('anggota.create');
    }

    public function store(Request $request)
    {
        $data = Validator::make($request->all(), [
            'nik' => 'required|string|max:16|unique:anggotas',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:15',
            'email' => 'nullable|email|unique:anggotas',
            'tanggal_bergabung' => 'required|date',
            'status' => 'required|in:aktif,nonaktif',
        ])->validate();

        Anggota::create($data);

        return redirect()->route('anggota.index')->with('success', 'Data Anggota berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);

        return view('anggota.edit', compact('anggota'));
    }

    public function update(Request $request, $id)
    {
        $anggota = Anggota::findOrFail($id);

        $data = Validator::make($request->all(), [
            'nik' => 'required|string|max:16|unique:anggotas,nik,' . $id,
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:15',
            'email' => 'nullable|email|unique:anggotas,email,' . $id,
            'tanggal_bergabung' => 'required|date',
            'status' => 'required|in:aktif,nonaktif',
        ])->validate();

        $anggota->update($data);

        return redirect()->route('anggota.index')->with('success', 'Data Anggota berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->delete();

        return redirect()->route('anggota.index')->with('success', 'Data Anggota berhasil dihapus.');
    }
}