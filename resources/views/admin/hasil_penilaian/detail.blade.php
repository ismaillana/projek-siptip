@extends('layouts.base')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('jurnal.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Detail Data Penilaian</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-warning ">
                        <strong>Keterangan Penilaian:</strong><br>
                        Kurang Sekali = 1, Kurang = 2, Baik = 3, Baik Sekali = 4
                    </div>

                    <div class="card">
                        <h6 class="card-header section-title mt-0 mb-0">Penilaian dari Junior ke senior</h6>
                        <div class="card-body" style="margin-top: -20px;">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label>Knowledge</label>
                                    <input class="form-control form-control-sm" value="{{$kaderisasi->uraian_keilmuan}}" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label>Topik</label>
                                    <input class="form-control form-control-sm" value="{{$kaderisasi->uraian_keilmuan}}" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label>Penilai</label>
                                    <input class="form-control form-control-sm" value="{{$kaderisasi->karyawanJunior->nik}}-{{$kaderisasi->karyawanJunior->user->name}}" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label>Dinilai</label>
                                    <input class="form-control form-control-sm" value="{{$kaderisasi->karyawanSenior->nik}}-{{$kaderisasi->karyawanSenior->user->name}}" disabled>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Pertanyaan</th>
                                            <th style="width: 10%">Nilai</th>
                                            <th style="width: 10%">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($penilaianJunior as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$item->soal}}</td>
                                                <td>{{$item->nilai_angka}}</td>
                                                <td>{{$item->nilai_huruf}}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" style="text-align: center;">Belum Ada Penilaian</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>                            
                        </div>
                    </div>

                    <div class="card">
                        <h6 class="card-header section-title mt-0 mb-0">Penilaian dari Senior ke Junior</h6>
                        <div class="card-body" style="margin-top: -20px;">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label>Knowledge</label>
                                    <input class="form-control form-control-sm" value="{{$kaderisasi->uraian_keilmuan}}" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label>Topik</label>
                                    <input class="form-control form-control-sm" value="{{$kaderisasi->uraian_keilmuan}}" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label>Penilai</label>
                                    <input class="form-control form-control-sm" value="{{$kaderisasi->karyawanSenior->nik}}-{{$kaderisasi->karyawanSenior->user->name}}" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label>Dinilai</label>
                                    <input class="form-control form-control-sm" value="{{$kaderisasi->karyawanJunior->nik}}-{{$kaderisasi->karyawanJunior->user->name}}" disabled>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Pertanyaan</th>
                                            <th style="width: 10%">Nilai</th>
                                            <th style="width: 10%">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($penilaianSenior as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$item->soal}}</td>
                                                <td>{{$item->nilai_angka}}</td>
                                                <td>{{$item->nilai_huruf}}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" style="text-align: center;">Belum Ada Penilaian</td>
                                            </tr>
                                        @endforelse
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

@section('script')
<script>
    $('#myForm').submit(function(e) {
        e.preventDefault();
        confirmSubmit(this);
    });

    function confirmSubmit(form) {
        Swal.fire({
            icon: 'question',
            text: 'Apakah anda yakin ingin menyimpan data ini ?',
            showCancelButton: true,
            buttonsStyling: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Simpan',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                let button = $('#btnSubmit');
                button.attr('disabled', 'disabled');
                $('#loader').removeClass('d-none');
                form.submit();
            }
        });
    }
</script>
@endsection
