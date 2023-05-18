@extends('layouts.master')

@section('content')
    <section class="app-user-list">
        <div class="row" id="basic-table">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Daftar Transaksi</h4>

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
                                   

                                    <form id="accept-form" action="{{ route('show-transaction') }}" method="GET" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i data-feather="all" class="me-50"></i>
                                            <span>Pending</span>
                                        </button>
                                    </form>

                                    <form id="accept-form" action="{{ route('show-Transaction-acc') }}" method="GET" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i data-feather="check" class="me-50"></i>
                                            <span>Accept</span>
                                        </button>
                                    </form>
                                    
                                    <form id="reject-form" action="{{ route('show-Transaction-dec') }}" method="GET" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i data-feather="trash" class="me-50"></i>
                                            <span>Reject</span>
                                        </button>
                                    </form>

                                    <form id="refund-form" action="{{ route('show-Transaction-ref') }}" method="GET" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i data-feather="trash" class="me-50"></i>
                                            <span>Refunded</span>
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
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Total Pembelian</th>
                                    <th>Nomor Hp</th>
                                    <th>Alamat</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody >
                                @foreach ($datas as $data)
                                   
                                        
                                    <tr>
                                        <td><div style="white-space: pre-wrap">{{ wordwrap(Str::limit($data->customer_name, 100), 30, "\n", true) }}</div></td>
                                        <td class="text-center">{{ $data->customer_email }}</td>
                                        <td>{{ 'Rp ' . number_format($data->gross_amount, 0, ',', '.') }}</td>
                                        <td>{{ $data->customer_phone }}</td>
                                        <td>{{ $data->address }}</td>
                                        {{-- <td>{{ $user->nomor_hp }}</td> --}}
           
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#transactionDetails{{ $data->id }}">
                                                Detail
                                            </button>


                                             <!-- Modal -->
        <div class="modal fade" id="transactionDetails{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="transactionDetails{{ $data->id }}Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="transactionDetails{{ $data->id }}Label">Detail Transaksi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <table class="mx-auto">
                            <tr>
                                <td>Total Pembelian</td>
                                <td>{{ 'Rp ' . number_format($data->gross_amount, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td>Nama Kustomer</td>
                                <td>{{ $data->customer_name }}</td>
                            </tr>
                            <tr>
                                <td>Email Kustomer</td>
                                <td>{{ $data->customer_email }}</td>
                            </tr>
                            <tr>
                                <td>Nomor Handphone</td>
                                <td>{{ $data->customer_phone }}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>{{ $data->address }}</td>
                            </tr>
                        </table>
                        

                        <div style="margin-bottom: 15px"></div>

                        <div class="text-center"> <!-- added class here -->
                            <table class="mx-auto">
                                <thead>
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th>Harga Barang</th>
                                        <th>Kuantitas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data->items as $item )
                                    <tr>
                                        <td>{{ $item->product_name }}</td>
                                        <td>{{ 'Rp ' . number_format($item->product_price, 0, ',', '.') }}</td>
                                        <td>{{ $item->quantity }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div style="margin-bottom: 15px"></div>
     
                    
                                                @if($data->status == 'accepted' || $data->status == 'rejected' || $data->status =='refunded' )
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <form action="{{ route('delete-Transaction', ['id' => $data->id]) }}" method="POST" style="display: inline;">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="delete" class="btn btn-sm btn-danger">
                                                            <span>Delete</span>
                                                        </button>
                                                    </form>
                                                </div>
                                                @else
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <form action="{{ route('onclick-Transaction', ['id' => $data->id]) }}" method="POST" style="display: inline;">
                                                        @method('put')
                                                        @csrf
                                                        <input type="hidden" name="pengajuan" value="accepted">
                                                        <button type="submit" class="btn btn-sm btn-success">
                                                            <span>Accept</span>
                                                        </button>
                                                    </form>

                                                </div>

                                                <div class="btn-group" role="group" aria-label="Basic example">

                                        
                                                    <form action="{{ route('onclick-Transaction', ['id' => $data->id]) }}" method="POST" style="display: inline;">
                                                        @method('put')
                                                        @csrf
                                                        <input type="hidden" name="pengajuan" value="refunded">
                                                        <button type="submit" class="btn btn-sm btn-warning">
                                                            <span>Refund</span>
                                                        </button>
                                                    </form>
                                                    
                                                </div>

                                                <div class="btn-group" role="group" aria-label="Basic example">

                                        
                                                    <form action="{{ route('onclick-Transaction', ['id' => $data->id]) }}" method="POST" style="display: inline;">
                                                        @method('put')
                                                        @csrf
                                                        <input type="hidden" name="pengajuan" value="rejected">
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <span>Reject</span>
                                                        </button>
                                                    </form>
                                                    
                                                </div>
                                                @endif
                                                



                                        
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                        </td>

                                    </tr>
                                </div>

                                
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
        
        
                                                  <!-- end modal -->

        </div>

    </section>
    <!-- users list ends -->
@endsection
