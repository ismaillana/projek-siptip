@extends('layouts.base')
@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <div class="section-header-back">
          <a href="{{route('kaderisasi.index')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>
            Tambah Data Kaderisasi
        </h1>
      </div>

      <form id="myForm" class="forms-sample" enctype="multipart/form-data" method="POST" 
        action="{{route('kaderisasi.store')}}">
        {{ csrf_field() }}
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <h5 class="card-header">Form Kaderisasi</h5>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label for="id_manager" class="col-md-2 col-form-label">Manager <sup
                                        class="text-danger">*</sup></label>
                                <div class="col-md-10">
                                    <select name="id_manager"
                                        class="form-control select2 @error('id_manager') is-invalid @enderror">
                                        <option value="" selected="" disabled="">
                                            Pilih Manager
                                        </option>

                                        @foreach ($managers as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('id_manager', @$kaderisasi->id_manager) == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('id_manager'))
                                        <span class="text-danger">
                                            {{ $errors->first('id_manager') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="id_karyawan_senior" class="col-md-2 col-form-label">Karyawan Senior <sup
                                        class="text-danger">*</sup></label>
                                <div class="col-md-10">
                                    <select name="id_karyawan_senior"
                                        class="form-control select2 @error('id_karyawan_senior') is-invalid @enderror">
                                        <option value="" selected="" disabled="">
                                            Pilih Karyawan Senior
                                        </option>

                                        @foreach ($karyawanSenior as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('id_karyawan_senior', @$kaderisasi->id_karyawan_senior) == $item->id ? 'selected' : '' }}>
                                                {{ $item->nama_lengkap }}
                                            </option>
                                        @endforeach
                                    </select>
                                    
                                    @if ($errors->has('id_karyawan_senior'))
                                        <span class="text-danger">
                                            {{ $errors->first('id_karyawan_senior') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="id_karyawan_junior" class="col-md-2 col-form-label">Karyawan Junior <sup
                                        class="text-danger">*</sup></label>
                                <div class="col-md-10">
                                    <select name="id_karyawan_junior"
                                        class="form-control select2 @error('id_karyawan_junior') is-invalid @enderror">
                                        <option value="" selected="" disabled="">
                                            Pilih Karyawan Junior
                                        </option>

                                        @foreach ($karyawanJunior as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('id_karyawan_junior', @$kaderisasi->id_karyawan_junior) == $item->id ? 'selected' : '' }}>
                                                {{ $item->nama_lengkap }}
                                            </option>
                                        @endforeach
                                    </select>
                                    
                                    @if ($errors->has('id_karyawan_junior'))
                                        <span class="text-danger">
                                            {{ $errors->first('id_karyawan_junior') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="uraian_keilmuan" class="col-md-2 col-form-label">uraian_keilmuan <sup
                                        class="text-danger">*</sup></label>
                                <div class="col-md-10">
                                    <textarea type="text" class="summernote-simple" id="uraian_keilmuan" name="uraian_keilmuan" placeholder="Masukan Judul Pekerjaan">
                                        {{ old('uraian_keilmuan', @$kaderisasi->uraian_keilmuan) }}
                                    </textarea>

                                    @if ($errors->has('uraian_keilmuan'))
                                        <span class="text-danger">
                                            {{ $errors->first('uraian_keilmuan') }}
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
