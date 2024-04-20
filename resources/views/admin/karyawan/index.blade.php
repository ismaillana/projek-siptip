@extends('layouts.base')
@section('content')
@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Tabel Data Karyawan</h1>
      </div>

      <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="d-flex justify-content-between w-100">
                    <h4>
                        Data Karyawan
                    </h4>

                    <a href="{{ route('karyawan.create') }}"
                        class="btn btn-outline-success btn-lg d-flex align-items-center ">
                        <i class="fa fa-plus pr-2"></i>
                        Tambah
                    </a>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped" id="myTable">
                    <thead>
                      <tr>
                        <th style="width: 10%">
                            #
                        </th>
                        
                        <th>
                            Nama
                        </th>

                        <th>
                            Email
                        </th>

                        <th>
                            Status
                        </th>

                        <th style="width: 10%">
                            Aksi
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($karyawan as $item)
                            <tr>
                                <td>
                                    {{$loop->iteration}}
                                </td>

                                <td>
                                    {{$item->nama_lengkap}}
                                </td>

                                <td>
                                    {{@$item->user->email}}
                                </td>

                                <td>
                                    @if ($item->status == 'Senior')
                                        <div class="badge badge-primary">Karyawan Senior</div>
                                    @elseif ($item->status == 'Junior')
                                        <div class="badge badge-primary">Karyawan Junior</div>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('karyawan.edit', $item->id) }}" title="Edit" class="btn btn-sm btn-outline-warning">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>  
@endsection