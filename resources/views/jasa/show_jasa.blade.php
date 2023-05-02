@extends('layouts.master')

@section('content')
    <section class="app-user-list">
        <div class="row" id="basic-table">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Daftar Jasa</h4>
                        <div class="form-modal-ex">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#inlineForm">
                                Tambah Jasa
                            </button>
                            <!-- Modal -->
                            <div class="modal fade text-start" id="inlineForm" tabindex="-1" aria-labelledby="myModalLabel33"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">

                                            <h4 class="modal-title" id="myModalLabel33">Tambahkan Jasa</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <form id="myForm" action="{{ route('show-jasa') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">

                                                <label>Nama Jasa</label>
                                                <div class="mb-1">
                                                    <input type="text" name="nama" placeholder="Masukkan Nama Barang"
                                                        class="form-control" />
                                                </div>

                                                @error('nama')
                                                <div class="text-danger mt-1">
                                                    {{ $message }}
                                                </div>
                                                @enderror

                                                <label>Harga Jasa</label>
                                                <div class="mb-1">
                                                    <input type="number" name="harga" placeholder="Masukkan Harga"
                                                        class="form-control" />
                                                </div>

                                                <label>Deskripsi</label>
                                                <div class="mb-1">
                                                    <input type="text" name="deskripsi" placeholder="Masukkan deskripsi" class="form-control" />
                                                </div>

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
                                                const gambar = document.querySelector('input[name="gambar"]');
                                                const deskripsi = document.querySelector('textarea[name="deskripsi"]');
                                                
                                                if (nama.value === '' || harga.value === '' || kuantitas.value === '' || alamat.value === '' || gambar.value === '' || deskripsi.value === '') {
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
                                    <th>Nama Jasa</th>
                                    <th>Harga</th>
                                    <th>Deskripsi</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                             <tbody >
                                @foreach ($produk as $data)
                                    <tr>
                                        <td>
                                            <img style="width: 150px; height:150px; border-radius :0"  src="{{asset($data->takeImage())}}" class="me-75" alt="Jasa" width="200px">
                                        </td>
                                
                                        <td><div style="white-space: pre-wrap">{{ wordwrap(Str::limit($data->nama, 100), 30, "\n", true) }}</div></td>

                                        <td>{{ 'Rp ' . number_format($data->harga, 0, ',', '.') }}</td>
                                       
                                        <td><div style="white-space: pre-wrap">{{ wordwrap(Str::limit($data->deskripsi, 100), 50, "\n", true) }}</div></td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-sm dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i data-feather="more-vertical"></i>
                                                </button>

                                                <div class="dropdown-menu">

                                                    <a class="dropdown-item"
                                                        href="{{ route('edit-jasa', ['id' => $data->id]) }}">
                                                        <i data-feather="edit-2" class="me-50"></i>
                                                        <span>Edit</span>
                                                    </a>

                                                    
                                                    <form action="{{ route('delete-jasa' , ['id' =>$data->id])}}" method="POST">

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