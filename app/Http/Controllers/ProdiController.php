<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\ValidatedData;

use function PHPUnit\Framework\returnSelf;

class ProdiController extends Controller
{
    public function index()
    {
        $prodi = Prodi::all();
        return view('prodi.index', compact ('prodi')); 
    }

    public function create()
    {
        return view('prodi.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate(
            [
                'nama_prodi' => 'required|unique:prodi|max:255'
            ],
            [
                'nama_prodi.required' => 'Nama Prodi harus diisi',
                'nama_prodi.unique' => 'Nama Prodi sudah ada',
                'nama_prodi.max' => 'Nama Prodi maksimal 255 karakter'
            ]
        );
            Prodi::create($validateData);
            flash()->success('Data Berhasil Ditambahkan');
            return redirect ('/prodi');
    }

    public function edit(String $id)
    {
        $prodi = Prodi::find($id);
        return view('prodi.edit', compact(['prodi']));
    }

    public function update(Request $request, string $id)
    {
        $validateData = $request->validate(
            [
                'nama_prodi' => 'required|unique:prodi|max:255'
            ],
            [
                'nama_prodi.required' => 'Nama Prodi harus diisi',
                'nama_prodi.unique' => 'Nama Prodi sudah ada',
                'nama_prodi.max' => 'Nama Prodi maksimal 255 karakter'
            ]
        );
        Prodi::where('id', $id)->update($validateData);
        flash()->success('Data Berhasil diedit');
        return redirect('/prodi');
    }

    public function destroy(string $id)
    {
        Prodi::destroy($id);
        flash()->success('Data Berhasil dihapus');
        return redirect('/prodi');
    }
}


