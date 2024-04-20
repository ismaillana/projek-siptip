@extends('layouts.base')
@section('content')
<style>
    .list-group-item .name-span {
        margin-right: 20px; /* Sesuaikan jarak antara span yang pertama dengan yang berikutnya di sini */
    }
</style>

<div class="main-content">
    <section class="section">
      <div class="section-header">
        <div class="section-header-back">
          <a href="{{route('penugasan.index')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>
            Tambah Data Penugasan
        </h1>
      </div>

      <form id="myForm" class="forms-sample" enctype="multipart/form-data" method="POST" 
        action="{{route('penugasan.store')}}">
        {{ csrf_field() }}
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <h5 class="card-header">Penugasan</h5>
                        <div class="card-body">
                            <ul class="list-group-item mb-3">
                                <p>Giver (Coach)</p>
                                <ul class="list-group list-group-flush mb-3">
                                    <li class="list-group-item">
                                        <span class="name-span">NIK / Organisasi / Nama</span>
                                        <strong><span>{{$kaderisasi->karyawanSenior->nik}} / {{$kaderisasi->karyawanSenior->organisasi}} / {{$kaderisasi->karyawanSenior->user->name}}</span></strong>
                                    </li>
                                    <li class="list-group-item">
                                        <span class="name-span">Job Code / Title</span>
                                        <strong><span>{{$kaderisasi->karyawanSenior->kode_pekerjaan}} / / {{$kaderisasi->karyawanSenior->judul_pekerjaan}}</span></strong>
                                    </li>
                                    <li class="list-group-item">Uraian Keilmuan :</li>
                                    <li class="list-group-item">
                                        <strong>{{$kaderisasi->uraian_keilmuan}}</strong>
                                    </li>
                                </ul>

                                <p style="margin-top: 20px">Receiver (Successor)</p>
                                <ul class="list-group list-group-flush mb-3">
                                    <li class="list-group-item">
                                        <span class="name-span">NIK / Organisasi / Nama</span>
                                        <strong><span>{{$kaderisasi->karyawanJunior->nik}} / {{$kaderisasi->karyawanJunior->organisasi}} / {{$kaderisasi->karyawanJunior->user->name}}</span></strong>
                                    </li>
                                    <li class="list-group-item">
                                        <span class="name-span">Job Code / Title</span>
                                        <strong><span>{{$kaderisasi->karyawanJunior->kode_pekerjaan}} / {{$kaderisasi->karyawanJunior->judul_pekerjaan}}</span></strong>
                                    </li>
                                    <li class="list-group-item">Uraian Keilmuan :</li>
                                    <li class="list-group-item">
                                        <strong>{{$kaderisasi->uraian_keilmuan}}</strong>
                                    </li>
                                </ul>
    
                                <div class="row align-items-center mb-3">
                                    <div class="col-md-6 col-sm-12">
                                        <label for="tanggal_awal" class="col-form-label">Tanggal Awal <sup
                                            class="text-danger">*</sup></label>
                                        <input type="date" class="form-control @error('tanggal_awal') is-invalid @enderror"
                                            id="tanggal_awal" name="tanggal_awal" placeholder="Masukan Tanggal Awal"
                                            value="{{ old('tanggal_awal', @$penugasan->tanggal_awal) }}">
    
                                        @if ($errors->has('tanggal_awal'))
                                            <span class="text-danger">
                                                {{ $errors->first('tanggal_awal') }}
                                            </span>
                                        @endif
                                    </div>
    
                                    <div class="col-md-6 col-sm-12">
                                        <label for="tanggal_akhir" class="col-form-label">Tanggal Akhir <sup
                                            class="text-danger">*</sup></label>
                                        <input type="date" class="form-control @error('tanggal_akhir') is-invalid @enderror"
                                            id="tanggal_akhir" name="tanggal_akhir" placeholder="Masukan Tanggal Akhir"
                                            value="{{ old('tanggal_akhir', @$penugasan->tanggal_akhir) }}">
    
                                        @if ($errors->has('tanggal_akhir'))
                                            <span class="text-danger">
                                                {{ $errors->first('tanggal_akhir') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="tugas" class="col-md-2 col-form-label">Tugas <sup
                                            class="text-danger">*</sup></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control @error('tugas') is-invalid @enderror"
                                            id="tugas" name="tugas" placeholder="Masukan Tugas"
                                            value="{{ old('tugas', @$penugasan->tugas) }}">
    
                                        @if ($errors->has('tugas'))
                                            <span class="text-danger">
                                                {{ $errors->first('tugas') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
    
                                <div class="mb-3 row">
                                    <label for="uraian_penugasan" class="col-md-2 col-form-label">Uraian Penugasan <sup
                                            class="text-danger">*</sup></label>
                                    <div class="col-md-10">
                                        <textarea type="text" class="summernote-simple" id="uraian_penugasan" name="uraian_penugasan" placeholder="Masukan Uraian Penugasan">
                                            {{ old('uraian_penugasan', @$penugasan->uraian_penugasan) }}
                                        </textarea>
    
                                        @if ($errors->has('uraian_penugasan'))
                                            <span class="text-danger">
                                                {{ $errors->first('uraian_penugasan') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary" id="btnSubmit">
                                            Simpan
                                            <span class="spinner-border ml-2 d-none" id="loader"
                                                style="width: 1rem; height: 1rem;" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </ul>
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
            let form = this;
            e.preventDefault();

            confirmSubmit(form);
        });
        // Form
        function confirmSubmit(form, buttonId) {
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
                    let button = 'btnSubmit';

                    if (buttonId) {
                        button = buttonId;
                    }

                    $('#' + button).attr('disabled', 'disabled');
                    $('#loader').removeClass('d-none');

                    form.submit();
                }
            });
        }

        document.getElementById('nik').addEventListener('input', function(evt) {
            var input = evt.target;
            input.value = input.value.replace(/[^0-9]/g, ''); 
        });
</script>
@endsection
