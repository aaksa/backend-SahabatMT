@extends('layouts.master')

@section('content')
    <!-- Basic multiple Column Form section start -->

    <!-- Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Jasa</h4>
                    </div>
                    <div class="card-body">
                        <form class="form"  action="/produk/jasa/{{$data->id}}" method="post">
                            @csrf
                            @method('put')
                            {{-- anu --}}
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="first-name-column">Nama Jasa</label>
                                        <input type="text" id="first-name-column" class="form-control"
                                            placeholder="Masukkan Nama Baru" value="{{$data->nama}}" name="nama" />
                                    </div>
                                    @error('title')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="first-name-column">Harga Jasa</label>
                                        <input type="number" id="first-name-column" class="form-control"
                                            placeholder="Masukkan Harga Baru" value="{{$data->harga}}" name="harga" />
                                    </div>
                                    @error('harga')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="deskripsi">Deskripsi</label>
                                        <textarea id="deskripsi" class="form-control"
                                                  placeholder="Masukkan Deskripsi Baru" name="deskripsi">{{$data->deskripsi}}</textarea>
                                    </div>
                                    @error('deskripsi')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            

                            {{-- Button Submit --}}
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary me-1">Submit</button>
                                <button type="reset" class="btn btn-outline-secondary">Reset</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection