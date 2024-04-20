@extends('layouts.base')
@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <div class="section-header-back">
          <a href="{{route('soal.index')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>
            Tambah Data Soal
        </h1>
      </div>

      <form id="myForm" class="forms-sample" enctype="multipart/form-data" method="POST" 
        action="{{route('soal.store')}}">
        {{ csrf_field() }}
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <h5 class="card-header">Form Soal</h5>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label for="to" class="col-md-2 col-form-label">Pertanyaan Untuk<sup
                                        class="text-danger">*</sup></label>
                                <div class="col-md-10">
                                    <select name="to"
                                        class="form-control select2 @error('to') is-invalid @enderror">
                                        <option disabled selected>Pilih Jenis Karyawan</option>
                                        <option value="Junior"
                                            {{ old('to', @$soal->to) == 'Junior' ? 'selected' : '' }}>
                                                Karyawan Junior</option>
                                        <option value="Senior"
                                            {{ old('to', @$soal->to) == 'Senior' ? 'selected' : '' }}>
                                                Karyawan Senior</option>
                                    </select>

                                    @if ($errors->has('to'))
                                        <span class="text-danger">
                                            {{ $errors->first('to') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="soal" class="col-md-2 col-form-label">Pertanyaan <sup
                                        class="text-danger">*</sup></label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control @error('soal') is-invalid @enderror"
                                        id="soal" name="soal" placeholder="Masukan Soal"
                                        value="{{ old('soal', @$soal->soal) }}">

                                    @if ($errors->has('soal'))
                                        <span class="text-danger">
                                            {{ $errors->first('soal') }}
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
