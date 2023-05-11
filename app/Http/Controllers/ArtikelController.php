<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    //

    public function showArtikel(Request $request){
        $datas = Artikel::all();

        return view('layouts.articles.show_article', compact('datas'));

    }

    public function fetchArtikel(){
        $datas = Artikel::all();
           return ResponseFormatter::success($datas, 'Artikel berhasil dimuat');

    }


    public function createArtikel(Request $request){
        $request->validate([
       'image' => ['required'],
       'title'=> ['required'],
       'content'=> ['required'],
   ]);

           $thumbnail = request()->file('image');
        $name = date('YmdHi')."-".$thumbnail->getClientOriginalName();
        $thumbnailUrl = $thumbnail->storeAs("images/produk",$name);

   $artikel = Artikel::create([
       'image' => $thumbnailUrl,
       'title' => $request->title,
       'content' => $request->content,
   ]);

//    return ResponseFormatter::success($artikel, 'Artikel berhasil dibuat');
return redirect('/artikel');

}


public function editArtikel($id){

    $data = Artikel::where('id',$id)->first();

    return view('layouts.article.edi', compact('data'));
}

public function deleteArtikel($id){
    $data = Artikel::where('id' ,$id)->first();
    $data->delete();
    return redirect('/artikel');
}


    // public function showRequest(){
    //     // $datas = ModelsRequest::all();
    //     $condi = 'OnGoing';
    //     $datas = ModelsRequest::where('pengajuan','ongoing')->get();
    //     $users = User::whereIn('id', $datas->pluck('user_id'))->get(); // Get users for the requests
    //     return view('requests.request_produk', compact('datas','condi','users'));
    // }


    // public function storeJasa(Request $request){

    //     $request->validate([
    //         'nama' => ['required'],
    //         'harga'=> ['required'],
    //         'deskripsi'=> ['required'],
    //         'gambar'=> ['required']
    //     ]);

    //     $thumbnail = request()->file('gambar');
    //     $name = date('YmdHi')."-".$thumbnail->getClientOriginalName();
    //     $thumbnailUrl = $thumbnail->storeAs("images/produk",$name);

    //     Jasa::create([
    //         'nama'=> $request->nama,
    //         'harga'=>$request->harga,
    //         'deskripsi'=>$request->deskripsi,
    //         'gambar'=>$thumbnailUrl
    //     ]);
        
    //     return redirect('/produk/jasa');
    // }

}
