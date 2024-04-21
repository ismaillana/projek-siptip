@extends('layouts.base')
@section('content')
@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Tabel Data Penugasan</h1>
      </div>

      <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="d-flex justify-content-between w-100">
                    <h4>
                        Data Penugasan
                    </h4>

                    {{-- <a href="{{ route('penugasan.create') }}"
                        class="btn btn-outline-success btn-lg d-flex align-items-center ">
                        <i class="fa fa-plus pr-2"></i>
                        Tambah
                    </a> --}}
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
                            Karyawan Senior
                        </th>

                        <th>
                            Karyawan Junior
                        </th>

                        <th>
                            Uraian Keilmuan
                        </th>

                        <th>
                            Tugas
                        </th>

                        <th style="width: 10%">
                            Aksi
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($kaderisasi as $item)
                            <tr>
                                <td>
                                    {{$loop->iteration}}
                                </td>

                                <td>
                                    {{$item->karyawanSenior->user->name}}
                                </td>

                                <td>
                                    {{$item->karyawanJunior->user->name}}
                                </td>

                                <td>
                                    {{$item->uraian_keilmuan}}
                                </td>

                                <td>
                                    @if ($item->tugas)
                                        {{$item->tugas}}
                                    @else
                                        Belum ada Penugasan
                                    @endif
                                </td>

                                <td>
                                    {{-- <a href="{{ route('penugasan.edit', $item->id) }}" title="Edit" class="btn btn-sm btn-outline-warning">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a> --}}

                                    <a href="{{ route('penugasan-create', $item->id) }}" title="Tambah / Update Data" class="btn btn-sm btn-outline-success">
                                        <i class="fa fa-plus"></i>
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