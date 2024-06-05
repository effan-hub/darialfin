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
        $data = ['nama' => 'hitler', 'foto' =>'opp.jpeg'];
        $prodi = Prodi::all();
        return view('prodi.index', compact ('data', 'prodi')); 
    }

    public function create()
    {
        $data = ['nama' => 'hitler', 'foto' =>'opp.jpeg'];
        return view('prodi.create', compact(['data']));
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
            return redirect ('/prodi');
    }

    public function edit(String $id)
    {
        $data = ['nama' => 'hitler', 'foto' =>'opp.jpeg'];
        $prodi = Prodi::find($id);
        return view('prodi.edit', compact(['data', 'prodi']));
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
        return redirect('/prodi');
    }

    public function destroy(string $id)
    {
        Prodi::destroy($id);
        return redirect('/prodi');
    }
}


