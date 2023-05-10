<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Request as ModelsRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    //

    public function showRequest(){
        // $datas = ModelsRequest::all();
        $condi = 'OnGoing';
        $datas = ModelsRequest::where('pengajuan','ongoing')->get();
        $users = User::whereIn('id', $datas->pluck('user_id'))->get(); // Get users for the requests
        return view('requests.request_produk', compact('datas','condi','users'));
    }

    public function showaccepted(){
        $condi = 'Accepted';
        $datas = ModelsRequest::where('pengajuan','accepted')->get();
        $users = User::whereIn('id', $datas->pluck('user_id'))->get(); // Get users for the requests
        return view('requests.request_produk', compact('datas','condi','users'));
    }

    public function showrejected(){
        $condi = 'Rejected';
        $datas = ModelsRequest::where('pengajuan','rejected')->get();
        $users = User::whereIn('id', $datas->pluck('user_id'))->get(); // Get users for the requests
        return view('requests.request_produk', compact('datas','condi','users'));
    }

    public function deleteRequest($id){
        $datana = ModelsRequest::where('id', $id )->first();
        $datana->delete();
        return redirect('/request');
    }

    // public function deleteJasa($id){
    //     $data = Jasa::where('id' ,$id)->first();
    //     $data->delete();
    //     return redirect(route('show-jasa'));
    // }

    public function onclickrequest($id, Request $request){

        ModelsRequest::where('id', $id)->update([
            'pengajuan'=>$request->pengajuan
        ]);

        $modelsRequest = ModelsRequest::where('id', $id)
        ->where('pengajuan', 'accepted') // Replace $value with the value you want to match for pengajuan
        ->first();

    if ($modelsRequest) {
        // $produk = new Produkmodel();
        // $produk->field1 = $modelsRequest->field1; // Replace field1, field2, ... with the fields you want to copy
        // $produk->field2 = $modelsRequest->field2;
        // // ...
        // $produk->save();
        Produk::create([
            'nama' => $modelsRequest->nama,
            'harga'=> $modelsRequest->harga,
            'gambar' => $modelsRequest->gambar,
            'kuantitas'=>$modelsRequest->kuantitas,
            'kondisi'=>$modelsRequest->kondisi,
         //    'provinsi'=>$request->provinsi,
         //    'alamat'=>$request->alamat,
            'deskripsi'=>$modelsRequest->deskripsi

        ]);
    }

        return redirect('/request');


    }



    // $request->validate([
    //     'nama' =>['required'],
    //     'harga'=>['required'],
    //     'deskripsi'=>['required']
    // ]);

    // Jasa::where('id' ,$id)->update([
    //     'nama'=>$request->nama,
    //     'harga'=>$request->harga,
    //     'deskripsi'=>$request->deskripsi
    // ]);

    // return redirect('produk/jasa');

}
