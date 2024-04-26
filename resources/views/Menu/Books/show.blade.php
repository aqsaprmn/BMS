@extends('Layout.main')

@section('heading')
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>{{ $title }}</h3>
            <p class="text-subtitle text-muted">For {{ auth()->user()->role }} see book data</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/books">Books</a></li>
                    <li class="breadcrumb-item"><a href="#">{{ $book->id }}</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
@endsection

@section('content')
    <div class="row match-height">
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title mb-0">Book Data</h4>
                    </div>
                    <div>
                        <a href="/books/{{ $book->uuid }}/edit" class="btn btn-primary">Edit Book</a>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <table class="table table-bordered table-hover table-striped">
                            <tr>
                                <th>Title</th>
                                <td class="text-center">:</td>
                                <td>{{ $book->title }}</td>
                            </tr>
                            <tr>
                                <th>Writer</th>
                                <td class="text-center">:</td>
                                <td>{{ $book->writer }}</td>
                            </tr>
                            <tr>
                                <th>Year</th>
                                <td class="text-center">:</td>
                                <td>{{ $book->publish_year }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td class="text-center">:</td>
                                <td>{!! $book->status == 'A'
                                    ? '<span class="text-success">Available</span>'
                                    : '<span class="text-danger">Not Available</span>' !!}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
