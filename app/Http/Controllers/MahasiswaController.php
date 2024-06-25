<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Prodi;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $mahasiswa = Mahasiswa::with('prodi')->get();
        return view('mahasiswa.index', compact(['mahasiswa']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $prodi = Prodi::all();
        return view('mahasiswa.create', compact(['prodi']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validateData = $request->validate(
            [
                'nim' => 'required|unique:mahasiswa|max:255',
                'nama' => 'required|max:255',
                'prodi_id' => 'required',
                'no_hp' => 'required|max:255',
                'alamat' => 'required|max:255',
                'foto' => 'image|file|max:2048'
            ],
            [
                'nim.required' => 'NIM harus diisi',
                'nim.unique' => 'NIM sudah ada',
                'nim.max' => 'NIM maksimal 255 karakter',
                'nama.required' => 'Nama harus diisi',
                'prodi_id.required' => 'Prodi harus diisi',
                'no_hp.required' => 'No Hp harus diisi',
                'alamat.required' => 'Alamat harus diisi',
                'foto.image' => 'Tolong upload file foto',
                'foto.max' => 'Ukuran foto maksimal 2MB'
            ]
        );
        if ($request->file('foto')) {
            $validateData['foto'] = $request->file('foto')->store('images');
        }
        $user = ([
            'user' => $validateData['nim'],
            'password' => Hash::make($validateData['nim']),
            'role' => 'mahasiswa'

        ]);
        Mahasiswa::create($validateData);
        User::create($user);
        return redirect('/mahasiswa');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $mahasiswa = Mahasiswa::find($id);
        $prodi = Prodi::all();
        return view('mahasiswa.edit', compact(['mahasiswa', 'prodi']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validateData = $request->validate(
            [
                'nim' => 'required|max:255',
                'nama' => 'required|max:255',
                'prodi_id' => 'required',
                'no_hp' => 'required|max:255',
                'alamat' => 'required|max:255',
                'foto' => 'image|file|max:2048'
            ],
            [
                'nim.required' => 'NIM harus diisi',
                'nim.unique' => 'NIM sudah ada',
                'nim.max' => 'NIM maksimal 255 karakter',
                'nama.required' => 'Nama harus diisi',
                'prodi_id.required' => 'Prodi harus diisi',
                'no_hp.required' => 'No Hp harus diisi',
                'alamat.required' => 'Alamat harus diisi',
                'foto.image' => 'Tolong upload file foto',
                'foto.max' => 'Ukuran foto maksimal 2MB'
            ]
        );

        $mahasiswa = Mahasiswa::find($id);
        if ($request->file('foto')) {
            if ($mahasiswa->foto) {
                Storage::delete($mahasiswa->foto);
            }
            $validateData['foto'] = $request->file('foto')->store('images');
        }
        Mahasiswa::where('nim', $id)->update($validateData);
        return redirect('/mahasiswa');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $mahasiswa = Mahasiswa::find($id);
        if ($mahasiswa->foto) {
            Storage::delete($mahasiswa->foto);
        }
        Mahasiswa::destroy($id);
        User::where('user', $id)->delete();
        flash()->success('Data Berhasil dihapus');
        return redirect('/mahasiswa');
    }
}
