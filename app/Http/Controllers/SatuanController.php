<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SatuanController extends Controller
{
    public function index()
    {
        $satuans = Satuan::get();
        return view('satuan.index',compact('satuans'));
    }

    public function store(Request $request)
    {
        Validator::make($request->all(),[
            'satuan' => 'required',
            'deskripsi' => 'required',
        ])->validate();

        Satuan::create([
            'satuan' => $request->satuan,
            'deskripsi' => $request->deskripsi,
            'status' => 'Aktif',
        ]);
    
        return redirect()->route('satuan')->with('success', 'Sukses tambah data');
    }

    public function update(Request $request, string $id)
    {
        Validator::make($request->all(),[
            'satuan' => 'required',
            'deskripsi' => 'required',
        ])->validate();

        $satuan = Satuan::findOrFail($id);
        
        if($satuan){
            $satuan->update([
                'satuan' => $request->satuan,
                'deskripsi' => $request->deskripsi,
            ]);
        }
        return redirect()->route('satuan')->with('success', 'Sukses update data');
    }

    public function changeStatus(Request $request, string $id)
    {
        Validator::make($request->all(),[
            'status' => 'required',
        ])->validate();

        $satuan = Satuan::findOrFail($id);
        
        if($satuan){
            $satuan->update([
                'status' => $request->status,
            ]);
        }
        
        return redirect()->route('satuan')->with('success', 'Sukses update data');
    }

    public function destroy(string $id)
    {
        $mahasiswa = Satuan::findOrFail($id);

        $mahasiswa->delete();

        return redirect()->route('satuan')->with('success', 'Sukses hapus data');
    }
}
