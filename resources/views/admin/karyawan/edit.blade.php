@extends('layouts.base')
@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <div class="section-header-back">
          <a href="{{route('karyawan.index')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>
            Edit Data Karyawan
        </h1>
      </div>

      <form id="myForm" class="forms-sample" enctype="multipart/form-data" method="POST"
        action="{{route('karyawan.update', $karyawan) }}">
        @method('put')
        {{ csrf_field() }}
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <h5 class="card-header">Form Karyawan</h5>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label for="name" class="col-md-2 col-form-label">Nama <sup
                                        class="text-danger">*</sup></label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" placeholder="Masukan Nama"
                                        value="{{ old('name', @$karyawan->user->name) }}">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">
                                            {{ $errors->first('name') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="username" class="col-md-2 col-form-label">Username <sup
                                        class="text-danger">*</sup></label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                        id="username" name="username" placeholder="Masukan Username"
                                        value="{{ old('username', @$karyawan->user->username) }}">

                                    @if ($errors->has('username'))
                                        <span class="text-danger">
                                            {{ $errors->first('username') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="email" class="col-md-2 col-form-label">Email <sup
                                        class="text-danger">*</sup></label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" placeholder="Masukan Email"
                                        value="{{ old('email', @$karyawan->user->email) }}">
                                        
                                    @if ($errors->has('email'))
                                        <span class="text-danger">
                                            {{ $errors->first('email') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="nik" class="col-md-2 col-form-label">NIK <sup
                                        class="text-danger">*</sup></label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control @error('nik') is-invalid @enderror" 
                                        maxlength="16" id="nik" name="nik" placeholder="Masukkan NIK"
                                        value="{{ old('nik', @$karyawan->nik) }}">

                                    @if ($errors->has('nik'))
                                        <span class="text-danger">
                                            {{ $errors->first('nik') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="tanggal_lahir" class="col-md-2 col-form-label">Tanggal Lahir <sup
                                        class="text-danger">*</sup></label>
                                <div class="col-md-10">
                                    <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                        id="tanggal_lahir" name="tanggal_lahir" placeholder="Masukan Tanggal Lahir"
                                        value="{{ old('tanggal_lahir', @$karyawan->tanggal_lahir) }}">

                                    @if ($errors->has('tanggal_lahir'))
                                        <span class="text-danger">
                                            {{ $errors->first('tanggal_lahir') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="organisasi" class="col-md-2 col-form-label">Organisasi <sup
                                        class="text-danger">*</sup></label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control @error('organisasi') is-invalid @enderror"
                                        id="organisasi" name="organisasi" placeholder="Masukan Organisasi"
                                        value="{{ old('organisasi', @$karyawan->organisasi) }}">

                                    @if ($errors->has('organisasi'))
                                        <span class="text-danger">
                                            {{ $errors->first('organisasi') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="kode_pekerjaan" class="col-md-2 col-form-label">Kode Pekerjaan <sup
                                        class="text-danger">*</sup></label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control @error('kode_pekerjaan') is-invalid @enderror"
                                        id="kode_pekerjaan" name="kode_pekerjaan" placeholder="Masukan Kode Pekerjaan"
                                        value="{{ old('kode_pekerjaan', @$karyawan->kode_pekerjaan) }}">

                                    @if ($errors->has('kode_pekerjaan'))
                                        <span class="text-danger">
                                            {{ $errors->first('kode_pekerjaan') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="judul_pekerjaan" class="col-md-2 col-form-label">Judul Pekerjaan <sup
                                        class="text-danger">*</sup></label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control @error('judul_pekerjaan') is-invalid @enderror"
                                        id="judul_pekerjaan" name="judul_pekerjaan" placeholder="Masukan Judul Pekerjaan"
                                        value="{{ old('judul_pekerjaan', @$karyawan->judul_pekerjaan) }}">

                                    @if ($errors->has('judul_pekerjaan'))
                                        <span class="text-danger">
                                            {{ $errors->first('judul_pekerjaan') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="alamat" class="col-md-2 col-form-label">Alamat <sup
                                        class="text-danger">*</sup></label>
                                <div class="col-md-10">
                                    <textarea type="text" class="summernote-simple" id="alamat" name="alamat" placeholder="Masukan Judul Pekerjaan">
                                        {{ old('alamat', @$karyawan->alamat) }}
                                    </textarea>

                                    @if ($errors->has('alamat'))
                                        <span class="text-danger">
                                            {{ $errors->first('alamat') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="status" class="col-md-2 col-form-label">Pilih Status <sup
                                        class="text-danger">*</sup></label>
                                <div class="col-md-10">
                                    <select name="status"
                                        class="form-control selectric @error('status') is-invalid @enderror">
                                        <option value="" selected="" disabled="">
                                            Pilih Status
                                        </option>
                                        <option value="Senior"
                                            {{ old('status', @$karyawan->status) == 'Senior' ? 'selected' : '' }}>
                                                Karyawan Senior</option>
                                        <option value="Junior"
                                            {{ old('status', @$karyawan->status) == 'Junior' ? 'selected' : '' }}>
                                                Karyawan Junior</option>
                                    </select>

                                    @if ($errors->has('status'))
                                        <span class="text-danger">{{ $errors->first('status') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="password" class="col-md-2 col-form-label">Password <sup
                                        class="text-danger">*</sup></label>
                                <div class="col-md-10">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" placeholder="Masukan Password">
                                    @if ($errors->has('password'))
                                        <span class="text-danger">
                                            {{ $errors->first('password') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="konfirmasi_password" class="col-md-2 col-form-label">Konfirmasi Password <sup
                                        class="text-danger">*</sup></label>
                                <div class="col-md-10">
                                    <input type="password" class="form-control @error('konfirmasi_password') is-invalid @enderror"
                                        id="konfirmasi_password" name="konfirmasi_password" placeholder="Masukan Konfirmasi Password">

                                    @if ($errors->has('konfirmasi_password'))
                                        <span class="text-danger">
                                            {{ $errors->first('konfirmasi_password') }}
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
