@extends('layouts.base')
@section('content')
@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Tabel Data Jurnal Publish</h1>
      </div>

      <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="d-flex justify-content-between w-100">
                    <h4>
                        Data Jurnal Publish
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
                            Karyawan Senior
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
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($jurnal as $item)
                            <tr>
                                <td>
                                    {{$loop->iteration}}
                                </td>

                                <td>
                                    {{@$item->jurnal->penugasan->kaderisasi->karyawanSenior->user->name}}
                                </td>

                                <td>
                                    {{@$item->jurnal->penugasan->kaderisasi->karyawanJunior->user->name}}
                                </td>

                                <td>
                                    {{@$item->jurnal->penugasan->tanggal_awal}} - {{@$item->jurnal->penugasan->tanggal_akhir}}
                                </td>

                                <td>
                                    @if (@$item->jurnal->file_jurnal !== null )
                                        <a href="{{ asset('storage/file_jurnal/'. @$item->jurnal->file_jurnal)}}" download="{{@$item->jurnal->file_jurnal}}" title="Download Hasil" class="btn btn-sm btn-primary">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    @else
                                        Belum Ada Jurnal
                                    @endif
                                </td>

                                <td>
                                    @if ($item->jurnal->status_jurnal)
                                        {{$item->jurnal->status_jurnal}}
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