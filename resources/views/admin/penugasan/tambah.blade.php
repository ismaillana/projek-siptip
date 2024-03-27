@extends('layouts.base')
@section('content')
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
                        <h5 class="card-header">Form Penugasan</h5>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label for="kaderisasi_id" class="col-md-2 col-form-label">Kaderisasi <sup
                                        class="text-danger">*</sup></label>
                                <div class="col-md-10">
                                    <select name="kaderisasi_id"
                                        class="form-control select2 @error('kaderisasi_id') is-invalid @enderror">
                                        <option value="" selected="" disabled="">
                                            Pilih Kaderisasi
                                        </option>

                                        @foreach ($kaderisasi as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('kaderisasi_id', @$penugasan->kaderisasi_id) == $item->id ? 'selected' : '' }}>
                                                {{ $item->id }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('kaderisasi_id'))
                                        <span class="text-danger">
                                            {{ $errors->first('kaderisasi_id') }}
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
                                <label for="tanggal_awal" class="col-md-2 col-form-label">Tanggal Awal <sup
                                        class="text-danger">*</sup></label>
                                <div class="col-md-10">
                                    <input type="date" class="form-control @error('tanggal_awal') is-invalid @enderror"
                                        id="tanggal_awal" name="tanggal_awal" placeholder="Masukan Tanggal Awal"
                                        value="{{ old('tanggal_awal', @$penugasan->tanggal_awal) }}">

                                    @if ($errors->has('tanggal_awal'))
                                        <span class="text-danger">
                                            {{ $errors->first('tanggal_awal') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="tanggal_akhir" class="col-md-2 col-form-label">Tanggal Akhir <sup
                                        class="text-danger">*</sup></label>
                                <div class="col-md-10">
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
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12 ">
                            <button type="submit" class="btn btn-primary" id="btnSubmit">
                                Simpan
                                <span class="spinner-border ml-2 d-none" id="loader"
                                    style="width: 1rem; height: 1rem;" role="status">
                                    <span class="sr-only">Loading...</span>
                                </span>
                            </button>
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
