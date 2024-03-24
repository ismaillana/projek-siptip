@extends('layouts.base')
@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <div class="section-header-back">
          <a href="{{route('user.index')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>
            Edit Data Pengguna
        </h1>
      </div>

      <form id="myForm" class="forms-sample" enctype="multipart/form-data" method="POST"
        action="{{route('user.update', $user) }}">
        @method('put')
        {{ csrf_field() }}
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <h5 class="card-header">Form Pengguna</h5>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label for="name" class="col-md-2 col-form-label">Nama <sup
                                        class="text-danger">*</sup></label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" placeholder="Masukan Nama"
                                        value="{{ old('name', @$user->name) }}">
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
                                        value="{{ old('username', @$user->username) }}">

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
                                        value="{{ old('email', @$user->email) }}">
                                        
                                    @if ($errors->has('email'))
                                        <span class="text-danger">
                                            {{ $errors->first('email') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="role" class="col-md-2 col-form-label">Pilih Role <sup
                                        class="text-danger">*</sup></label>
                                <div class="col-md-10">
                                    <select name="role"
                                        class="form-control selectric @error('role') is-invalid @enderror">
                                        <option value="" selected="" disabled="">
                                            Pilih Role
                                        </option>

                                        @foreach ($role as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $userRoles->contains($item) ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('role'))
                                        <span class="text-danger">{{ $errors->first('role') }}</span>
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
</script>
@endsection
