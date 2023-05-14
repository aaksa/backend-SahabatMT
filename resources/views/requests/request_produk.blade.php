@extends('layouts.master')

@section('content')
    <section class="app-user-list">
        <div class="row" id="basic-table">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Daftar Request</h4>

                        <div class="btn-group">
            

                            {{-- <div class="dropdown-menu">
                              <a class="dropdown-item" href="#">Ongoing</a>
                              <a class="dropdown-item" href="#">Accepted</a>
                              <a class="dropdown-item" href="#">Rejected</a>
                            </div> --}}


                            {{--  --}}
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                   Filter ({{ $condi }})
                                </button>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                   

                                    <form id="accept-form" action="{{ route('show-request') }}" method="GET" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i data-feather="all" class="me-50"></i>
                                            <span>OnGoing</span>
                                        </button>
                                    </form>

                                    <form id="accept-form" action="{{ route('show-request-acc') }}" method="GET" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i data-feather="check" class="me-50"></i>
                                            <span>Accept</span>
                                        </button>
                                    </form>
                                    
                                    <form id="reject-form" action="{{ route('show-request-dec') }}" method="GET" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i data-feather="trash" class="me-50"></i>
                                            <span>Reject</span>
                                        </button>
                                    </form>

                                </div>
                            </div>
                            
                    
                            

                            {{--  --}}
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
                                    <th>Nomor Hp</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody >
                                @foreach ($datas as $data)
                                    @foreach ($users as $user )
                                        
                                    <tr>
                                        <td>
                                            <img style="width: 150px; height:100px; border-radius :0"  src="{{asset($data->takeImage())}}" class="me-75" alt="Produk" width="200px">
                                        </td>
                                        <td><div style="white-space: pre-wrap">{{ wordwrap(Str::limit($data->nama, 100), 30, "\n", true) }}</div></td>

                                        <td>{{ 'Rp ' . number_format($data->harga, 0, ',', '.') }}</td>
                                        <td class="text-center">
                                            <span class="badge {{ $data->kondisi === 'baru' ? 'badge-success' : 'badge-info-muted' }}">
                                                {{ $data->kondisi }}
                                            </span>
                                        </td>
                                        
                                        <td class="text-center">{{ $data->kuantitas }}</td>
                                        <td>{{ $data->provinsi }}</td>
                                        <td>{{ $data->alamat }}</td>
                                        <td><div style="white-space: pre-wrap">{{ wordwrap(Str::limit($data->deskripsi, 100), 50, "\n", true) }}</div></td>
                                        <td>{{ $user->nomor_hp }}</td>
           
                                        <td>
                                            @if($data->pengajuan == 'accepted' || $data->pengajuan == 'rejected')
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <form action="{{ route('delete-request', ['id' => $data->id]) }}" method="POST" style="display: inline;">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="delete" class="btn btn-sm btn-danger">
                                                            <span>Delete</span>
                                                        </button>
                                                    </form>
                                                </div>
                                            @else
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <form action="{{ route('onclick-request', ['id' => $data->id]) }}" method="POST" style="display: inline;">
                                                        @method('put')
                                                        @csrf
                                                        <input type="hidden" name="pengajuan" value="accepted">
                                                        <button type="submit" class="btn btn-sm btn-success">
                                                            <span>Accept</span>
                                                        </button>
                                                    </form>
                                        
                                                    <form action="{{ route('onclick-request', ['id' => $data->id]) }}" method="POST" style="display: inline;">
                                                        @method('put')
                                                        @csrf
                                                        <input type="hidden" name="pengajuan" value="rejected">
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <span>Reject</span>
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        </td>
                              

                                    </tr>
                                    @endforeach
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
