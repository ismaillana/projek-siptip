@extends('layouts.base')
@section('content')
@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Tabel Data Hasil Penilaian</h1>
      </div>

      <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="d-flex justify-content-between w-100">
                    <h4>
                        Data Hasil Penilaian
                    </h4>

                    <a href="{{ route('jurnal.create') }}"
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
                            Tugas
                        </th>

                        <th>
                            Jurnal
                        </th>

                        <th>
                            Status Hasil Penilaian
                        </th>

                        <th style="width: 10%">
                            Aksi
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($jurnal as $item)
                            <tr>
                                <td>
                                    {{$loop->iteration}}
                                </td>

                                <td>
                                    {{$item->tugas}}
                                </td>

                                <td>
                                    @if ($item->file_jurnal !== null )
                                        <a href="{{ asset('storage/file_jurnal/'. $item->file_jurnal)}}" 
                                        download="{{$item->file_jurnal}}"
                                        class="btn btn-sm btn-outline-primary" title="Download Hasil">
                                            {{-- <i class="fas fa-download"> --}}
                                            Unduh File
                                        </a>
                                    @else
                                        Belum Ada Hasil
                                    @endif
                                </td>

                                <td>
                                    {{$item->status_jurnal}}
                                </td>

                                <td>
                                    <a href="{{ route('penilaian.create', $item->id) }}" title="Edit" class="btn btn-sm btn-outline-warning">
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