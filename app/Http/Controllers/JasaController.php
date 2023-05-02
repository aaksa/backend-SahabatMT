<?php

namespace App\Http\Controllers;

use App\Models\Jasa;
use Illuminate\Http\Request;

class JasaController extends Controller
{
    //

    public function showJasa(){
        $produk = Jasa::all();
        return view('jasa.show_jasa',compact('produk'));
    }

    public function storeJasa(Request $request){

        $request->validate([
            'nama' => ['required'],
            'harga'=> ['required'],
            'deskripsi'=> ['required'],
            'gambar'=> ['required']
        ]);

        $thumbnail = request()->file('gambar');
        $name = date('YmdHi')."-".$thumbnail->getClientOriginalName();
        $thumbnailUrl = $thumbnail->storeAs("images/produk",$name);

        Jasa::create([
            'nama'=> $request->nama,
            'harga'=>$request->harga,
            'deskripsi'=>$request->deskripsi,
            'gambar'=>$thumbnailUrl
        ]);
        
        return redirect('/produk/jasa');
    }

    public function deleteJasa($id){
        $data = Jasa::where('id' ,$id)->first();
        $data->delete();
        return redirect(route('show-jasa'));
    }

    public function editJasa($id){

        $data = Jasa::where('id',$id)->first();

        return view('jasa.edit_jasa', compact('data'));
    }

    public function updateJasa(Request $request,$id){
        $request->validate([
            'nama' =>['required'],
            'harga'=>['required'],
            'deskripsi'=>['required']
        ]);

        Jasa::where('id' ,$id)->update([
            'nama'=>$request->nama,
            'harga'=>$request->harga,
            'deskripsi'=>$request->deskripsi
        ]);

        return redirect('produk/jasa');
    }

    // public function updateProduk(Request $request, $id){
    //     $request->validate([
    //         'nama' => ['required'],
    //         'harga' =>['required'],
    //         'kuantitas'=> ['required'],
    //         'kondisi'=>['required'],
    //         'provinsi'=>['required'],
    //         'alamat'=>['required'],
    //         'deskripsi'=>['required']
    //     ]);

    //     Produk::where('id', $id)->update([
    //             'nama' => $request->nama,
    //             'harga'=> $request->harga,
    //             'kuantitas'=>$request->kuantitas,
    //             'kondisi'=>$request->kondisi,
    //             'provinsi'=>$request->provinsi,
    //             'alamat'=>$request->alamat,
    //             'deskripsi'=>$request->deskripsi
    //     ]);

    //     return redirect('produk/barang');
    // }

}
