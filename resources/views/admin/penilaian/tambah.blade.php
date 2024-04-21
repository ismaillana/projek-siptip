@extends('layouts.base')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('jurnal.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Tambah Data Penilaian</h1>
        </div>

        <form id="myForm" class="forms-sample" enctype="multipart/form-data" method="POST" action="{{ route('nilai-senior.store', $kaderisasi->id) }}">
            {{ csrf_field() }}
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-warning ">
                            <strong>Keterangan Penilaian:</strong><br>
                            Kurang Sekali = 1, Kurang = 2, Baik = 3, Baik Sekali = 4
                        </div>

                        <div class="card">
                            <h6 class="card-header">Form Penilaian</h6>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Pertanyaan</th>
                                                <th style="width: 10%">Nilai</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($soal as $item)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$item->soal}}</td>
                                                    <td>
                                                        <input type="hidden" name="soal[]" value="{{$item->soal}}">
                                                        <select name="nilai_angka[]" class="form-control">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary float-right" id="btnSubmit">Simpan<span class="spinner-border ml-2 d-none" id="loader" style="width: 1rem; height: 1rem;" role="status"><span class="sr-only">Loading...</span></span></button>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
