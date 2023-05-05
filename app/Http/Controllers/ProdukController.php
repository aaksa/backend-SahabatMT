<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Request as ModelsRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProdukController extends Controller
{
    
    private $provinces = array(
        "Aceh",
        "Sumatera Utara",
        "Sumatera Barat",
        "Riau",
        "Jambi",
        "Sumatera Selatan",
        "Bengkulu",
        "Lampung",
        "Bangka Belitung",
        "Kepulauan Riau",
        "Jakarta",
        "Jawa Barat",
        "Jawa Tengah",
        "Yogyakarta",
        "Jawa Timur",
        "Banten",
        "Bali",
        "Nusa Tenggara Barat",
        "Nusa Tenggara Timur",
        "Kalimantan Barat",
        "Kalimantan Tengah",
        "Kalimantan Selatan",
        "Kalimantan Timur",
        "Kalimantan Utara",
        "Sulawesi Utara",
        "Sulawesi Tengah",
        "Sulawesi Selatan",
        "Sulawesi Tenggara",
        "Gorontalo",
        "Maluku",
        "Maluku Utara",
        "Papua",
        "Papua Barat"
    );

    public function showProduk(){
        $provinces = $this->provinces;
        $Produksi = Produk::all();
        return view('produk.show_produk' ,compact('Produksi', 'provinces') );
    }

    public function storeProduk(Request $request){
    
        // $request->validate([
        //     'nama' => ['required'],
        //     'harga' =>['required'],
        //     'gambar' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        //     'kuantitas'=> ['required'],
        //     'kondisi'=>['required'],
        //     'provinsi'=>['required'],
        //     'alamat'=>['required'],
        //     'deskripsi'=>['required']
        // ]);
        // $validator = Validator::make($request->all(), [
        //     'nama' => ['required'],
        //     'harga' =>['required'],
        //     'gambar' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        //     'kuantitas'=> ['required'],
        //     'kondisi'=>['required'],
        //     'provinsi'=>['required'],
        //     'alamat'=>['required'],
        //     'deskripsi'=>['required']
        // ]);

        $validator = Validator::make($request->all(), [
            'nama' => ['required'],
            'harga' => ['required'],
            'gambar' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg'],
            'gambar.*' => ['dimensions:max_width=1000,max_height=1000', function ($attribute, $value, $fail) {
                if ($value->getSize() > 2048000) { // max file size in bytes
                    $fail('The :attribute must not exceed 2MB.');
                }
            }],
            'kuantitas' => ['required'],
            'kondisi' => ['required'],
            'provinsi' => ['required'],
            'alamat' => ['required'],
            'deskripsi' => ['required']
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

               // Assign Image
               $thumbnail = request()->file('gambar');
               $name = date('YmdHi')."-".$thumbnail->getClientOriginalName();
               $thumbnailUrl = $thumbnail->storeAs("images/produk",$name);
       
               Produk::create([
                   'nama' => $request->nama,
                   'harga'=> $request->harga,
                   'gambar' => $thumbnailUrl,
                   'kuantitas'=>$request->kuantitas,
                   'kondisi'=>$request->kondisi,
                   'provinsi'=>$request->provinsi,
                   'alamat'=>$request->alamat,
                   'deskripsi'=>$request->deskripsi
               ]);

        return redirect('/produk/barang');
    }

    public function deleteProduk ($id){
        $data = Produk::where('id', $id)->first();
        $data->delete();
        return redirect(route('show-produk'));
    }

    public function editProduk($id){

       $provinsiOptions = $this->provinces;

        $data = Produk::where('id', $id)->first();

        return view('produk.edit_produk', compact('data', 'provinsiOptions'));
    }

    
    public function updateProduk(Request $request, $id){
        $request->validate([
            'nama' => ['required'],
            'harga' =>['required'],
            'kuantitas'=> ['required'],
            'kondisi'=>['required'],
            'provinsi'=>['required'],
            'alamat'=>['required'],
            'deskripsi'=>['required']
        ]);

        Produk::where('id', $id)->update([
                'nama' => $request->nama,
                'harga'=> $request->harga,
                'kuantitas'=>$request->kuantitas,
                'kondisi'=>$request->kondisi,
                'provinsi'=>$request->provinsi,
                'alamat'=>$request->alamat,
                'deskripsi'=>$request->deskripsi
        ]);

        return redirect('produk/barang');
    }
}
