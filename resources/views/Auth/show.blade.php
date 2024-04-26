@extends('Layout.main')

@section('heading')
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>{{ $title }}</h3>
            <p class="text-subtitle text-muted">Untuk {{ auth()->user()->role }} lihat data pengguna</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/user">Pengguna</a></li>
                    <li class="breadcrumb-item"><a href="#">{{ $user->id }}</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
@endsection

@section('content')
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title mb-0">Data Pengguna</h4>
                    </div>
                    <div>
                        <a href="{{ url("user/$user->user_id/edit") }}" class="btn btn-primary">Edit Pengguna</a>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <table class="table table-bordered table-hover table-striped">
                            <tr>
                                <th>Nama</th>
                                <td class="text-center">:</td>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th>Peran</th>
                                <td class="text-center">:</td>
                                <td>{{ $user->role }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td class="text-center">:</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th>Handphone</th>
                                <td class="text-center">:</td>
                                <td>{{ $user->hp }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td class="text-center">:</td>
                                <td>{!! $user->status === 'A'
                                    ? '<span class="badge bg-success text-white">Aktif</span>'
                                    : '<span class="badge bg-danger text-white">Non-Aktif</span>' !!}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
