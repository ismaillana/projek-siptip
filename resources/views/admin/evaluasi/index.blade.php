@extends('layouts.base')
@section('content')
@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Tabel Data Evaluasi</h1>
      </div>

      <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="d-flex justify-content-between w-100">
                    <h4>
                        Data Evaluasi
                    </h4>
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
                            Karyawan Junior
                        </th>

                        <th>
                            Periode
                        </th>

                        <th>
                            Jurnal
                        </th>

                        <th>
                            Status Jurnal
                        </th>

                        <th style="width: 10%">
                            Aksi
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($penugasan as $item)
                            <tr>
                                <td>
                                    {{$loop->iteration}}
                                </td>

                                <td>
                                    {{@$item->kaderisasi->karyawanJunior->user->name}}
                                </td>

                                <td>
                                    {{$item->tanggal_awal}} - {{$item->tanggal_akhir}}
                                </td>

                                <td>
                                    @if ($item->file_jurnal !== null )
                                        <a href="{{ asset('storage/file_jurnal/'. $item->file_jurnal)}}" download="{{$item->file_jurnal}}" title="Download Hasil" class="btn btn-sm btn-primary">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    @else
                                        Belum Ada Jurnal
                                    @endif
                                </td>

                                <td>
                                    @if ($item->status_jurnal)
                                        {{$item->status_jurnal}}
                                    @else
                                        Belum ada jurnal
                                    @endif
                                </td>

                                <td>
                                    @if ($item->status_jurnal == 'Belum Dikerjakan')
                                        Belum Ada Aksi
                                    @elseif ($item->status_jurnal == 'Review Manager')
                                        <button type="button" class="btn btn-sm btn-outline-warning" title="Button Disabled" disabled>
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                    @elseif($item->status_jurnal == 'Selesai')
                                      @php
                                          $penilaian = \App\Models\Penilaian::where('kaderisasi_id', $item->kaderisasi_id)
                                              ->where('id_penilai', $item->kaderisasi->karyawanSenior->id)
                                              ->first();
                                      @endphp
                                  
                                        @if (!$penilaian)
                                            <a href="{{ route('nilai-junior', $item->kaderisasi_id) }}" title="Penilaian" class="btn btn-sm btn-outline-success">
                                                <i class="fas fa-thumbtack"></i>
                                            </a>
                                        @endif
                                        <button type="button" class="btn btn-sm btn-outline-warning" title="Button Disabled" disabled>
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                    @elseif ($item->status_jurnal == 'Revisi Senior' || $item->status_jurnal == 'Review')
                                        <a href="{{ route('evaluasi-edit', $item->id) }}" title="Evaluasi" class="btn btn-sm btn-outline-warning">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                    @else
                                        Belum ada jurnal
                                    @endif
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