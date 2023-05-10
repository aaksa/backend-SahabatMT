@extends('layouts.master')

@section('content')
    <!-- Basic multiple Column Form section start -->

    <!-- Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Barang</h4>
                    </div>
                    <div class="card-body">
                        <form class="form"  action="/produk/barang/{{$data->id}}" method="post">
                            @csrf
                            @method('put')

                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="first-name-column">Nama Barang</label>
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
                                        <label class="form-label" for="first-name-column">Harga</label>
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
                                    <label class="form-label" for="kondisi">Kondisi</label>
                                    <select id="kondisi" class="form-control" name="kondisi">
                                      <option value="baru" {{ $data->kondisi === 'baru' ? 'selected' : '' }}>Baru</option>
                                      <option value="bekas" {{ $data->kondisi === 'bekas' ? 'selected' : '' }}>Bekas</option>
                                    </select>
                                  </div>
                                  @error('kondisi')
                                  <div class="text-danger mt-1">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                              </div>
                              
                            
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="kuantitas">Kuantitas</label>
                                        <input type="number" id="kuantitas" class="form-control"
                                               placeholder="Masukkan Kuantitas Baru" value="{{$data->kuantitas}}" name="kuantitas" />
                                    </div>
                                    @error('kuantitas')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            
                            {{-- <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="provinsi">Provinsi</label>
                                        <select id="provinsi" name="provinsi" class="form-select">
                                            <option value="">Pilih Provinsi</option>
                                            @foreach($provinsiOptions as $provinsiOption)
                                            <option value="{{ $provinsiOption }}" {{ $data->provinsi == $provinsiOption ? 'selected' : '' }}>
                                                {{ $provinsiOption }}
                                            </option>
                                            @endforeach
                                        </select>
                                        
                                    </div>
                                    @error('provinsi')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div> --}}
                            
                            
                            {{-- <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="alamat">Alamat</label>
                                        <input type="text" id="alamat" class="form-control"
                                               placeholder="Masukkan Alamat Baru" value="{{$data->alamat}}" name="alamat" />
                                    </div>
                                    @error('alamat')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div> --}}
                            
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