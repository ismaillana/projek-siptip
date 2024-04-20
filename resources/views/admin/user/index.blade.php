@extends('layouts.base')
@section('content')
@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Tabel Data Pengguna</h1>
      </div>

      <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="d-flex justify-content-between w-100">
                    <h4>
                        Data Pengguna
                    </h4>

                    <a href="{{ route('user.create') }}"
                        class="btn btn-outline-success btn-lg d-flex align-items-center ">
                        <i class="fa fa-plus pr-2"></i>
                        Tambah
                    </a>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped" id="myTable">
                    <thead>
                      <tr>
                        <th style="width: 10%">
                            #
                        </th>
                        
                        <th>
                            Nama
                        </th>

                        <th>
                            Username
                        </th>

                        <th>
                            Email
                        </th>

                        <th>
                            Role
                        </th>

                        <th style="width: 10%">
                            Aksi
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $item)
                            <tr>
                                <td>
                                    {{$loop->iteration}}
                                </td>

                                <td>
                                    {{$item->name}}
                                </td>

                                <td>
                                    {{$item->username}}
                                </td>

                                <td>
                                    {{$item->email}}
                                </td>

                                <td>
                                    @if ($item->getRoleNames()[0] == 'admin-it')
                                        <div class="badge badge-primary">Admin IT</div>
                                    @elseif ($item->getRoleNames()[0] == 'admin-corporate')
                                        <div class="badge badge-primary">Admin Corporate</div>
                                    @elseif ($item->getRoleNames()[0] == 'manager')
                                        <div class="badge badge-primary">Manager</div>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('user.edit', $item->id) }}" title="Edit" class="btn btn-sm btn-outline-warning">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
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