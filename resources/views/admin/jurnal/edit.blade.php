@extends('layouts.base')
@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <div class="section-header-back">
          <a href="{{route('jurnal.index')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>
            Edit Data Jurnal
        </h1>
      </div>

      <form id="myForm" class="forms-sample" enctype="multipart/form-data" method="POST"
        action="{{route('jurnal-update', $penugasan->id) }}">
        @method('put')
        {{ csrf_field() }}
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <h5 class="card-header">Form Jurnal</h5>
                        <div class="card-body">
                            <p><b style="color: #044879">Revisi Senior</b></p>
                            <div class="row">
                                <label for="tugas" class="col-md-2">
                                    File Revisi
                                </label>
                                <label for="tugas" class="col-md-8">
                                    @if (isset($jurnal->file_revisi))
                                        <a href="{{ asset('storage/file_revisi/'. $jurnal->file_revisi)}}" 
                                            download="{{$jurnal->file_revisi}}"
                                            class="btn btn-sm btn-outline-primary" title="Download Hasil">
                                                Unduh File Revisi
                                        </a>
                                    @else
                                        Belum Ada Revisi
                                    @endif
                                </label>
                            </div>
                            <hr style="margin-top: -5px;">
                            <div class="row">
                                <label for="tugas" class="col-md-2">
                                    Uraian Revisi
                                </label>
                                <label for="tugas" class="col-md-8">
                                    @if (isset($jurnal->uraian_revisi))
                                        {{ $jurnal->uraian_revisi }}
                                    @else
                                        Belum Ada Revisi
                                    @endif
                                </label>
                            </div>
                            <hr style="margin-top: -5px;">
                            <p><b style="color: #044879">Revisi Manager</b></p>
                            <div class="row">
                                <label for="tugas" class="col-md-2">
                                    File Revisi
                                </label>
                                <label for="tugas" class="col-md-8">
                                    @if (isset($jurnal->file_revisi_manager))
                                        {{ $jurnal->file_revisi_manager }}
                                    @else
                                        Belum Ada Revisi
                                    @endif
                                </label>
                            </div>
                            <hr style="margin-top: -5px;">
                            <div class="row">
                                <label for="tugas" class="col-md-2">
                                    Uraian Revisi
                                </label>
                                <label for="tugas" class="col-md-8">
                                    @if (isset($jurnal->uraian_revisi_manager))
                                        {{ $jurnal->uraian_revisi_manager }}
                                    @else
                                        Belum Ada Revisi
                                    @endif
                                </label>
                            </div>
                            <hr style="margin-top: -5px;">

                            <div class="mb-3 row">
                                <label for="status_jurnal" class="col-md-2 col-form-label">Status Jurnal</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value="{{ $jurnal->status_jurnal }}" disabled>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="file_jurnal" class="col-md-2 col-form-label">File Jurnal <sup
                                        class="text-danger">*</sup></label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <input class="dropify @error('file_jurnal') is-invalid @enderror" type="file" 
                                            name="file_jurnal" data-height='250' data-default-file="{{@$jurnal->file_url}}" data-allowed-file-extensions="pdf" data-max-file-size="5M" value="image_url">
                                    </div>

                                    @if ($errors->has('file_jurnal'))
                                        <span class="text-danger">
                                            {{ $errors->first('file_jurnal') }}
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
