@extends('Layout.main')

@section('heading')
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>{{ $title }}</h3>
            <p class="text-subtitle text-muted">For {{ auth()->user()->role }} edit book data</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/books">Books</a></li>
                </ol>
            </nav>
        </div>
    </div>
@endsection

@section('content')
    <section id="multiple-column-form">
        <form class="form" action="{{ url('/books') }}/{{ $book->uuid }}" method="post">
            @method('patch')
            @csrf
            <div class="row match-height">
                <div class="col-lg-6">
                    <div class="card mb-3">
                        <div class="card-header pb-0">
                            <h4 class="card-title mb-0">Book Data</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group">
                                        <label for="title">Title <sup>*</sup></label>
                                        <input type="text" id="title"
                                            class="form-control @error('title') is-invalid @enderror"
                                            placeholder="Enter title" name="title"
                                            value="{{ old('title', $book->title) }}">
                                        @error('title')
                                            <div class=" invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="writer">Writer <sup>*</sup></label>
                                        <input type="text" id="writer"
                                            class="form-control @error('writer') is-invalid @enderror"
                                            placeholder="Enter writer" name="writer"
                                            value="{{ old('writer', $book->writer) }}">
                                        @error('writer')
                                            <div class=" invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <x-input-number identity="publish_year" label="Year" placeholder="Enter year"
                                            value="{{ $book->publish_year }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card mb-3">
                        <div class="card-header pb-0">
                            <h4 class="card-title mb-0">Status Data</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <x-select-form label="Status" identity="status" optionFirst="Pilih Status"
                                                :row="$status" select="{{ $book->status }}" match="id" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <x-action to="books" />
                </div>
            </div>
        </form>
    </section>
@endsection
