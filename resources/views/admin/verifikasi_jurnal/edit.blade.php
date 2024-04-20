@extends('layouts.base')
@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <div class="section-header-back">
          <a href="{{route('evaluasi.index')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>
            Edit Data Verifikasi Jurnal
        </h1>
      </div>

      <form id="myForm" class="forms-sample" enctype="multipart/form-data" method="POST"
        action="{{route('verifikasi-jurnal-update', $penugasan->id) }}">
        @method('put')
        {{ csrf_field() }}
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <h5 class="card-header">Form Verifikasi Jurnal</h5>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label for="file_jurnal" class="col-md-2 col-form-label">File Jurnal <sup
                                        class="text-danger">*</sup></label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <input class="form-control" type="text" value="{{ @$evaluasi->file_jurnal }}" disabled>
                                        <div class="input-group-append">
                                            <a href="{{ @$evaluasi->file_url }}" class="btn btn-outline-primary" target="_blank" rel="noopener noreferrer">Unduh</a>
                                        </div>
                                    </div>

                                    @if ($errors->has('file_jurnal'))
                                        <span class="text-danger">
                                            {{ $errors->first('file_jurnal') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="status_jurnal" class="col-md-2 col-form-label">Status<sup
                                        class="text-danger">*</sup></label>
                                <div class="col-md-10">
                                    <select name="status_jurnal"
                                        class="form-control select2 @error('status_jurnal') is-invalid @enderror">
                                        <option selected disabled value="">Pilih Status</option>
                                        <option value="Revisi Manager"
                                            {{ old('status_jurnal', @$evaluasi->status_jurnal) == 'Revisi Manager' ? 'selected' : '' }}>
                                            Revisi</option>
                                        <option value="Selesai"
                                            {{ old('status_jurnal', @$evaluasi->status_jurnal) == 'Selesai' ? 'selected' : '' }}>
                                            Selesai</option>
                                    </select>

                                    @if ($errors->has('status_jurnal'))
                                        <span class="text-danger">
                                            {{ $errors->first('status_jurnal') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3 row" id="fileRevisiSection" style="display: none;">
                                <label for="file_revisi_manager" class="col-md-2 col-form-label">File Revisi <sup
                                        class="text-danger">*</sup></label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <input class="dropify @error('file_revisi_manager') is-invalid @enderror" type="file" 
                                            name="file_revisi_manager" data-height='250' data-default-file="{{@$evaluasi->file_revisi_manager_url}}" data-allowed-file-extensions="pdf" data-max-file-size="5M" value="file_revisi_manager_url">
                                    </div>

                                    @if ($errors->has('file_revisi_manager'))
                                        <span class="text-danger">
                                            {{ $errors->first('file_revisi_manager') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3 row" id="uraianRevisiSection" style="display: none;">
                                <label for="uraian_revisi" class="col-md-2 col-form-label">Uraian Revisi <sup
                                        class="text-danger">*</sup></label>
                                <div class="col-md-10">
                                    <textarea type="text" class="summernote-simple" id="uraian_revisi" name="uraian_revisi" placeholder="Masukan Uraian Revisi">
                                        {{ old('uraian_revisi', @$evaluasi->uraian_revisi) }}
                                    </textarea>

                                    @if ($errors->has('uraian_revisi'))
                                        <span class="text-danger">
                                            {{ $errors->first('uraian_revisi') }}
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

        $(document).ready(function() {
        // Mendapatkan element select status jurnal
        const statusJurnalSelect = $('select[name="status_jurnal"]');

        // Mendapatkan element field input file_revisi dan uraian_revisi
        const fileRevisiSection = $('#fileRevisiSection');
        const uraianRevisiSection = $('#uraianRevisiSection');

        // Menambahkan event listener pada perubahan nilai select status jurnal
        statusJurnalSelect.on('change', function() {
            const selectedStatus = $(this).val();

            // Menampilkan field input file_revisi dan uraian_revisi jika status jurnal Revisi
            if (selectedStatus === 'Revisi Manager') {
            fileRevisiSection.show();
            uraianRevisiSection.show();
            } else {
            // Menyembunyikan field input file_revisi dan uraian_revisi jika status jurnal bukan Revisi
            fileRevisiSection.hide();
            uraianRevisiSection.hide();
            }
        });

        // Memicu event change pada select status jurnal untuk memunculkan/menyembunyikan field input
        // sesuai dengan nilai yang telah dipilih sebelumnya
        statusJurnalSelect.trigger('change');
        });

</script>
@endsection
