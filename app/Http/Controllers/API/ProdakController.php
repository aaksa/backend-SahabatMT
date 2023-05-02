<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Jasa;
use App\Models\Produk;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;

class ProdakController extends Controller
{
    //

    public function semua(){
       $produks =  Produk::all();

       if($produks){
        return ResponseFormatter::success($produks, 'Data Berhasil Diambil');
    }else{
        return ResponseFormatter::error(null, 'Data Tidak Ada', 404);
    }
    }

    public function semuajasa(){
        $jasa = Jasa::all();

        if($jasa){
            return ResponseFormatter::success($jasa, 'Data Berhasil Diambil');
        }else{
            return ResponseFormatter::error(null, 'Data Tidak Ada', 404);
        }
    }

    public function rekuest($user_id){

        try {
            $models = ModelsRequest::where('user_id', $user_id)->get();
            return ResponseFormatter::success(['data' => $models], 'Data berhasil ditambahkan');
        } catch (\Exception $error) {
            return ResponseFormatter::error(['message' => 'something went wrong' , 'error' => $error], "Data gagal ditambahkan", '500');
        }
    //     try{
    //     $user_id = $request->id;
    //     $models = ModelsRequest::where('user_id', $user_id)->get();
    //     return ResponseFormatter::success(['data' => $models], 'Data berhasil ditambahkan');

    // }catch (\Exception $error) {
    //     return ResponseFormatter::error(['message' => 'something went wrong' , 'error' => $error], "Data gagal ditambahkan", '500');
    // }
    }
    
    public function upload(Request $request) {

        try{

        $request->validate([
            'nama'=>['required'],
            'gambar'=>['required'],
            'pengajuan'=>['required'],
            'harga'=>['required'],
            'deskripsi'=>['required'],
            'kondisi'=>['required'],
            'alamat'=>['required'],
            'provinsi'=>['required'],
            'kuantitas'=>['required'],
            'user_id'=>['required'],
        ]);

        $thumbnail = request()->file('gambar');
        $name = date('YmdHi')."-".$thumbnail->getClientOriginalName();
        $thumbnailUrl = $thumbnail->storeAs("images/produk",$name);

        $upload = ModelsRequest::create([
            'nama'=>$request->nama,
            'gambar'=>$thumbnailUrl,
            'pengajuan'=>$request->pengajuan,
            'harga'=>$request->harga,
            'deskripsi'=>$request->deskripsi,
            'kondisi'=>$request->kondisi,
            'alamat'=>$request->alamat,
            'provinsi'=>$request->provinsi,
            'kuantitas'=>$request->kuantitas,
            'user_id'=>$request->user_id,
        ]);

        return ResponseFormatter::success(['data' => $upload], 'Data berhasil ditambahkan');
        
        }catch (\Exception $error) {
            return ResponseFormatter::error(['message' => 'something went wrong' , 'error' => $error], "Data gagal ditambahkan", '500');
        }
    }
}