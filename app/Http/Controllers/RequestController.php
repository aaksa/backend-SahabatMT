<?php

namespace App\Http\Controllers;

use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    //

    public function showRequest(){
        // $datas = ModelsRequest::all();
        $condi = 'OnGoing';
        $datas = ModelsRequest::where('pengajuan','ongoing')->get();
 
        return view('requests.request_produk', compact('datas','condi'));
    }

    public function showaccepted(){
        $condi = 'Accepted';
        $datas = ModelsRequest::where('pengajuan','accepted')->get();
        return view('requests.request_produk', compact('datas','condi'));
    }

    public function showrejected(){
        $condi = 'Rejected';
        $datas = ModelsRequest::where('pengajuan','rejected')->get();
        return view('requests.request_produk', compact('datas','condi'));
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
