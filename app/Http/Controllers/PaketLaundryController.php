<?php

namespace App\Http\Controllers;

use App\Models\PaketLaundry;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaketLaundryController extends Controller
{
    public function index()
    {
        $pakets = PaketLaundry::get();
        $satuans = Satuan::get();
        return view('paket_laundry.index',compact('pakets', 'satuans'));
    }

    public function store(Request $request)
    {
        Validator::make($request->all(),[
            'nama' => 'required',
            'berat' => 'required|numeric',
            'harga' => 'required|numeric',
            'satuan' => 'required',
            'cabang' => 'required',
        ])->validate();

        PaketLaundry::create([
            'nama' => $request->nama,
            'berat' => $request->berat,
            'harga' => $request->harga,
            'satuan_id' => $request->satuan,
            'cabang' => $request->cabang,
            'status' => 'Aktif',
        ]);
    
        return redirect()->route('paket')->with('success', 'Sukses tambah data');
    }

    public function update(Request $request, string $id)
    {
        Validator::make($request->all(),[
            'nama' => 'required',
            'berat' => 'required|numeric',
            'harga' => 'required|numeric',
            'satuan' => 'required',
            'cabang' => 'required',
        ])->validate();

        $satuan = PaketLaundry::findOrFail($id);
        
        if($satuan){
            $satuan->update([
                'nama' => $request->nama,
                'berat' => $request->berat,
                'harga' => $request->harga,
                'satuan_id' => $request->satuan,
                'cabang' => $request->cabang,
            ]);
        }
        return redirect()->route('paket')->with('success', 'Sukses update data');
    }

    public function changeStatus(Request $request, string $id)
    {
        Validator::make($request->all(),[
            'status' => 'required',
        ])->validate();

        $satuan = PaketLaundry::findOrFail($id);
        
        if($satuan){
            $satuan->update([
                'status' => $request->status,
            ]);
        }
        
        return redirect()->route('paket')->with('success', 'Sukses update data');
    }

    public function destroy(string $id)
    {
        $mahasiswa = PaketLaundry::findOrFail($id);

        $mahasiswa->delete();

        return redirect()->route('paket')->with('success', 'Sukses hapus data');
    }
}
