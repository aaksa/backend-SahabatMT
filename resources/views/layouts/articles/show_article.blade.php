@extends('layouts.master')

@section('content')
    <section class="app-user-list">
        <div class="row" id="basic-table">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Daftar Artikel</h4>
                        <div class="form-modal-ex">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#inlineForm">
                                Tambah Artikel
                            </button>
                            <!-- Modal -->
                            <div class="modal fade text-start" id="inlineForm" tabindex="-1" aria-labelledby="myModalLabel33"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel33">Tambahkan Artikel</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <form id="myForm" action="{{ route('create-article') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                        
                                                <label>Image</label>
                                                <div class="mb-1">
                                                    <input type="file" name="image" class="form-control" />
                                                </div>
                                        
                                                @error('image')
                                                    <div class="text-danger mt-1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                        
                                                <label>Title</label>
                                                <div class="mb-1">
                                                    <input type="text" name="title" placeholder="Enter title" class="form-control" />
                                                </div>
                                        
                                                @error('title')
                                                    <div class="text-danger mt-1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                        
                                                <label>Content</label>
                                                <div class="mb-1">
                                                    <textarea name="content" placeholder="Enter content" class="form-control" style="white-space: pre-wrap;"></textarea>
                                                </div>
                                                
                                        
                                                @error('content')
                                                    <div class="text-danger mt-1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                        
                                            </div>
                                        
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Create</button>
                                            </div>
                                        
                                        </form>
                                        

                                        {{-- <script>
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

                                                if (nama.value === '' || harga.value === '' || kuantitas.value === '' || gambar.value === '' || deskripsi.value === '') {
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




                                        </script> --}}
                                        

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
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody >
                                @foreach ($datas as $data)
                                    <tr>
                                        <td>
                                            <img style="width: 150px; height:100px; border-radius :0"  src="{{asset($data->takeImage())}}" class="me-75" alt="Artikel" width="200px">
                                        </td>
                                        {{-- <td>{{ $data->nama }}</td> --}}
                                        {{-- <td><div style="white-space: pre-wrap">{{ wordwrap(Str::limit($data->nama, 100), 30, "\n", true) }}</div></td> --}}

            
                                        <td class="text-start">{{ $data->title }}</td>
                                        <td class="text-start">{!! nl2br(wordwrap($data->content, 59, "<br>", true)) !!}</td>

                                    
                                        {{-- Action button --}}
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-sm dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i data-feather="more-vertical"></i>
                                                </button>

                                                <div class="dropdown-menu">

                                                    {{-- <a class="dropdown-item"
                                                        href="{{ route('edit-article', ['id' => $data->id]) }}">
                                                        <i data-feather="edit-2" class="me-50"></i>
                                                        <span>Edit</span>
                                                    </a> --}}

                                                    
                                                    <form action="{{ route('delete-article' , ['id' =>$data->id])}}" method="POST">
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
