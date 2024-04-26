@extends('Layout.main')

@section('heading')
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>{{ $title }}</h3>
            <p class="text-subtitle text-muted">For {{ auth()->user()->role }} check books data</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/master/package">Books</a></li>
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
                        Books list
                    </div>
                    <div class="col-md-6 justify-content-end d-flex">
                        <a href="/books/create" class="btn btn-primary">Add Book</a>
                    </div>

                </div>
            </div>
            <hr class="mt-0">
            <div class="card-body">
                <table id="data" class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Writer</th>
                            <th>Year</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $book->title }}</td>
                                <td class="whitespace-nowrap">{{ $book->writer }}</td>
                                <td>{{ $book->publish_year }}</td>
                                <td>{!! $book->status == 'A'
                                    ? '<span class="text-success">Available</span>'
                                    : '<span class="text-danger">Not Available</span>' !!}
                                </td>
                                <td class="">
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ url('books') }}/{{ $book->uuid }}"
                                            class="btn btn-info me-1 d-flex align-items-center"><i
                                                class="bi bi-eye me-2"></i>
                                            Lihat
                                        </a>
                                        <a href="{{ url('books') }}/{{ $book->uuid }}/edit"
                                            class="btn btn-primary me-1 d-flex align-items-center"><i
                                                class="bi bi-pencil-square me-2"></i> Edit
                                        </a>
                                        <form action="{{ url('books') }}/{{ $book->uuid }}" method="POST"
                                            class="me-1">
                                            @method('DELETE')
                                            @csrf
                                            <button type="button" id=""
                                                class="btn btn-danger delete d-flex align-items-center"><i
                                                    class="bi bi-trash me-2 delete"></i> Hapus</button>
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
            $("#data").click(function(e) {
                const target = e.target;

                if (target.classList.contains("delete")) {
                    let form = target.closest("form");

                    Swal.fire({
                        title: 'Yakin hapus data ini?',
                        text: "Data akan terhapus permanent!",
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

        let data = document.querySelector("#data");
        let dataTabledata = new simpleDatatables.DataTable(data);
    </script>
@endsection
