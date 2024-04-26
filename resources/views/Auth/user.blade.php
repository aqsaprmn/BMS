@extends('Layout.main')

@section('heading')
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>{{ $title }}</h3>
            <p class="text-subtitle text-muted">Untuk <b>admin</b> melihat daftar pengguna</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/user">Pengguna</a></li>
                </ol>
            </nav>
        </div>
    </div>
@endsection

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header py-3">
                <div class="row mx-0 align-items-center">
                    <div class="col-md-6">
                        Daftar Pengguna
                    </div>
                    <div class="col-md-6 justify-content-end d-flex">
                        <a href="{{ url('user/create') }}" class="btn btn-primary">Tambah Pengguna</a>
                    </div>
                </div>
            </div>
            <hr class="mt-0">
            <div class="card-body">
                <table class="table table-striped" id="user">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Peran</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No. Telpon</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users->skip(1) as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->role }}</td>
                                <td class=" whitespace-nowrap">{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->hp }}</td>
                                <td class="text-center">
                                    @if ($user->status == 'A')
                                        <span class="badge bg-light-success">Aktif</span>
                                    @else
                                        <span class="badge bg-light-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td class="">
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ url('user') }}/{{ $user->user_id }}"
                                            class="btn btn-info me-1 d-flex align-items-center">
                                            <i class="bi bi-eye me-2"></i>
                                            Lihat
                                        </a>
                                        <a href="{{ url('user') }}/{{ $user->user_id }}/edit"
                                            class="btn btn-primary me-1 d-flex align-items-center"><i
                                                class="bi bi-pencil-square me-2"></i> Edit</a>

                                        <form action="{{ url('user') }}/{{ $user->user_id }}" method="POST"
                                            class="me-1 delete">
                                            @method('DELETE')
                                            @csrf
                                            <button type="button"
                                                class="btn btn-danger d-flex align-items-center delete"><i
                                                    class="bi bi-trash me-2 delete"></i> Hapus</button>
                                        </form>

                                        <form action="{{ url('user') }}/activation/{{ $user->user_id }}" method="POST"
                                            class="me-1 activation" data-status="{{ $user->status }}">
                                            @method('patch')
                                            @csrf
                                            <button type="button"
                                                class="btn btn-light-{{ $user->status == 'A' ? 'danger' : 'success' }} d-flex align-items-center activation whitespace-nowrap"><i
                                                    class="bi bi-calendar2-check me-2 activation"></i>
                                                {{ $user->status == 'A' ? 'Non-Aktif' : 'Aktifkan' }}</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $("#user").click(function(e) {
                const target = e.target;

                const form = target.closest("form")
                if (target.classList.contains("delete")) {

                    Swal.fire({
                        title: 'Yakin hapus pelanggan ini?',
                        text: "Pelanggan akan terhapus permanent!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    })

                } else if (target.classList.contains("activation")) {

                    const status = $(".activation").attr("data-status");

                    let title = ""
                    let text = ""

                    if (status === "A") {
                        title = "non-aktif"
                        text = "Non-Aktif"
                    } else {
                        title = "aktifkan"
                        text = "Aktifkan"
                    }

                    Swal.fire({
                        title: `Yakin untuk ${title}?`,
                        text: `Pengguna akan di ${text}!`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    })
                }
            })

        })

        let user = document.querySelector("#user");
        let dataTableUser = new simpleDatatables.DataTable(user);
    </script>
@endsection
