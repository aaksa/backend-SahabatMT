@extends('layouts.master')

@section('content')
    <section class="app-user-list">
        <div class="row" id="basic-table">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Daftar Produk</h4>
                        <div class="form-modal-ex">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#inlineForm">
                                Tambah Produk
                            </button>
                            <!-- Modal -->
                            <div class="modal fade text-start" id="inlineForm" tabindex="-1" aria-labelledby="myModalLabel33"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel33">Tambahkan Produk</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <form id="myForm" action="{{ route('show-produk') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">

                                                <label>Nama Produk</label>
                                                <div class="mb-1">
                                                    <input type="text" name="nama" placeholder="Masukkan Nama Barang"
                                                        class="form-control" />
                                                </div>

                                                @error('nama')
                                                <div class="text-danger mt-1">
                                                    {{ $message }}
                                                </div>
                                                @enderror

                                                <label>Harga Produk</label>
                                                <div class="mb-1">
                                                    <input type="number" name="harga" placeholder="Masukkan Harga"
                                                        class="form-control" />
                                                </div>

                                                @error('harga')
                                                <div class="text-danger mt-1">
                                                    {{ $message }}
                                                </div>
                                                @enderror

                                                <label>Jumlah / Kuantitas</label>
                                                <div class="mb-1">
                                                    <input type="number" name="kuantitas" placeholder="Masukkan Jumlah" class="form-control" />
                                                </div>
                                                @error('kuantitas')
                                                <div class="text-danger mt-1">
                                                    {{ $message }}
                                                </div>
                                                @enderror

                                                <label>Kondisi </label>
                                                <div class="mb-1">
                                                    <select name="kondisi" class="form-select">
                                                        <option value="Baru">Baru</option>
                                                        <option value="Bekas">Bekas</option>
                                                    </select>
                                                </div>
                                                @error('kondisi')
                                                <div class="text-danger mt-1">
                                                    {{ $message }}
                                                </div>
                                                @enderror

                                                <label>Alamat</label>
                                                <div class="mb-1">
                                                    <input type="text" name="alamat" placeholder="Masukkan Alamat"
                                                        class="form-control" />
                                                </div>
                                                @error('alamat')
                                                <div class="text-danger mt-1">
                                                    {{ $message }}
                                                </div>
                                                @enderror

                                                {{-- <label>Provinsi</label>
                                                <div class="mb-1">
                                                    <input type="text" name="provinsi" placeholder="Masukkan Provinsi"
                                                        class="form-control" />
                                                </div> --}}
                                                {{-- select and search provinve  --}}

                                                <label>Provinsi</label>
                                                <div class="mb-1">
                                                    <select class="form-select search-select" name="provinsi" id="provinsi">
                                                        <option value="">Pilih Provinsi</option>
                                                        @foreach ($provinces as $provinsi)
                                                            <option value="{{ $provinsi }}">{{ $provinsi }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('provinsi')
                                                <div class="text-danger mt-1">
                                                    {{ $message }}
                                                </div>
                                                @enderror



                                                {{--end select  --}}
                                                <label>Upload Gambar</label>
                                                <div class="mb-1"">
                                                    {{-- <label for="formFile" class="form-label">Upload Gambar</label> --}}
                                                    <input class="form-control" type="file" id="formFile" name="gambar">
                                                </div>
                                                @error('gambar')
                                                    <div class="text-danger mt-1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror

                                                <label>Deskripsi</label>
                                                <div class="mb-1">
                                                    <textarea name="deskripsi" placeholder="Masukkan Deskripsi Produk" class="form-control"></textarea>
                                                </div>

                                                @error('deskripsi')
                                                <div class="text-danger mt-1">
                                                    {{ $message }}
                                                </div>
                                                @enderror

                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Daftar</button>
                                            </div>
                                            
                                        </form>

                                        <script>
                                            const myForm = document.querySelector('#myForm');
                                            myForm.addEventListener('submit', function(event) {
                                                // Validate input fields
                                                const nama = document.querySelector('input[name="nama"]');
                                                const harga = document.querySelector('input[name="harga"]');
                                                const kuantitas = document.querySelector('input[name="kuantitas"]');
                                                const alamat = document.querySelector('input[name="alamat"]');
                                                const provinsi =document.querySelector('input[name="provinsi"]');
                                                const gambar = document.querySelector('input[name="gambar"]');
                                                const deskripsi = document.querySelector('textarea[name="deskripsi"]');
                                                
                                                 // Check image size
                                                const MAX_IMAGE_SIZE = 2000000; // maximum image size in bytes
                                                if (gambar.files.length === 0 || gambar.files[0].size > MAX_IMAGE_SIZE) {
                                                    event.preventDefault(); // prevent form submission if there are errors
                                                    swal({
                                                    title: "Error",
                                                    text: "Gambar harus diisi dan ukurannya tidak boleh lebih dari 2MB.",
                                                    type: "error",
                                                    confirmButtonText: "OK"
                                                    });
                                                    return;
                                                }

                                                if (nama.value === '' || harga.value === '' || kuantitas.value === ''|| provinsi.value === '' || alamat.value === '' || gambar.value === '' || deskripsi.value === '') {
                                                    event.preventDefault(); // prevent form submission if there are errors
                                                    swal({
                                                        title: "Error",
                                                        text: "Ada kesalahan dalam menambahkan produk. Silahkan periksa kembali data yang diinput.",
                                                        type: "error",
                                                        confirmButtonText: "OK"
                                                    });
                                                } else {
                                                    swal({
                                                        title: "Success",
                                                        text: "Data Berhasil Diinput.",
                                                        type: "success",
                                                        confirmButtonText: "OK"
                                                    }).then(function(){
                                                        event.target.submit(); // submit the form
                                                    });
                                                }
                                            });




                                        </script>
                                        

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Gambar</th>
                                    <th>Nama Barang</th>
                                    <th>Harga</th>
                                    <th>Kondisi</th>
                                    <th>Kuantitas</th>
                                    <th>Provinsi</th>
                                    <th>Alamat</th>
                                    <th>Deskripsi</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody >
                                @foreach ($Produksi as $data)
                                    <tr>
                                        <td>
                                            <img style="width: 150px; height:100px; border-radius :0"  src="{{asset($data->takeImage())}}" class="me-75" alt="Produk" width="200px">
                                        </td>
                                        {{-- <td>{{ $data->nama }}</td> --}}
                                        <td><div style="white-space: pre-wrap">{{ wordwrap(Str::limit($data->nama, 100), 30, "\n", true) }}</div></td>

                                        <td>{{ 'Rp ' . number_format($data->harga, 0, ',', '.') }}</td>
                                        {{-- <td class="text-center"> <span class="badge badge-danger-muted text-white">{{ $data->kondisi }}</span> </td> --}}
                                        <td class="text-center">
                                            <span class="badge {{ $data->kondisi === 'baru' ? 'badge-success' : 'badge-info-muted' }}">
                                                {{ $data->kondisi }}
                                            </span>
                                        </td>
                                        
                                        <td class="text-center">{{ $data->kuantitas }}</td>
                                        <td>{{ $data->provinsi }}</td>
                                        <td>{{ $data->alamat }}</td>
                                        <td><div style="white-space: pre-wrap">{{ wordwrap(Str::limit($data->deskripsi, 100), 50, "\n", true) }}</div></td>

                                        {{-- <td>{{ wordwrap(Str::limit( $data->deskripsi, 100), 5, "\n", true) }}</td> --}}
                                    
                                        {{-- Action button --}}
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-sm dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i data-feather="more-vertical"></i>
                                                </button>

                                                <div class="dropdown-menu">

                                                    <a class="dropdown-item"
                                                        href="{{ route('edit-produk', ['id' => $data->id]) }}">
                                                        <i data-feather="edit-2" class="me-50"></i>
                                                        <span>Edit</span>
                                                    </a>

                                                    
                                                    <form action="{{ route('delete-produk' , ['id' =>$data->id])}}" method="POST">
                                                        {{-- <form action="{{ route('/', ['id'=>$data->id]) }}" method="POST"> --}}
                                                        @method('delete')
                                                        @csrf
                                                        <button class="dropdown-item" type="submit">
                                                            <i data-feather="trash" class="me-50"></i>
                                                            <span>Delete</span>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                        {{-- end action --}}

                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
        </div>

    </section>
    <!-- users list ends -->
@endsection
