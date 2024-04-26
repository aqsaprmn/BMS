@extends('Layout.main')

@section('heading')
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>{{ $title }}</h3>
            <p class="text-subtitle text-muted">Untuk administrator menambah data pengguna</p>
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
    <section id="multiple-column-form">
        <form class="form" action="{{ url('user') }}" method="post">
            @csrf
            <div class="row match-height">
                <div class="col-lg-6">
                    <div class="card mb-3">
                        <div class="card-header pb-0">
                            <h4 class="card-title mb-0">Data Pengguna</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row mx-0">
                                    {{-- <div class="col-md-6 col-12">
                                        <div class="form-group">
                                      ..      <label for="username">Username</label>
                                            <input type="text" id="username" class="form-control"
                                                placeholder="Masukkan username" name="username" autofocus
                                                value="{{ old('username') }}">
                                        </div>
                                    </div> --}}
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input type="text" id="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Masukkan nama" name="name" value="{{ old('name') }}">
                                        @error('name')
                                            <div class=" invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" id="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            placeholder="Masukkan email" name="email" value="{{ old('email') }}">
                                        @error('email')
                                            <div class=" invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="hp">Handphone</label>
                                        <input type="text" id="hp"
                                            class="form-control @error('hp') is-invalid @enderror"
                                            placeholder="Masukkan handphone" name="hp" value="{{ old('hp') }}">
                                        @error('hp')
                                            <div class=" invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Peran</label>
                                        <select class="form-select @error('role') is-invalid @enderror" name="role"
                                            id="role">
                                            <option disabled selected value="">Pilih Peran</option>
                                            <option @if (old('role') == 'Sales') selected @endif value="Sales">Sales
                                            </option>
                                            <option @if (old('role') == 'Dispatcher') selected @endif value="Dispatcher">
                                                Dispatcher</option>
                                            <option @if (old('role') == 'OM') selected @endif value="OM">OM
                                            </option>
                                        </select>
                                        @error('role')
                                            <div class=" invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="position">Jabatan</label>
                                        <select class="form-select @error('position') is-invalid @enderror" name="position"
                                            id="position">
                                            <option disabled selected value="">Pilih Jabatan</option>
                                            <option @if (old('position') == 'Staff') selected @endif value="Staff">
                                                Staff
                                            </option>
                                            <option @if (old('position') == 'Supervisor') selected @endif value="Supervisor">
                                                Supervisor
                                            </option>
                                            <option @if (old('position') == 'Manager') selected @endif value="Manager">
                                                Manager
                                            </option>
                                            <option @if (old('position') == 'Direktur') selected @endif value="Direktur">
                                                Direktur
                                            </option>
                                        </select>
                                        @error('position')
                                            <div class=" invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card mb-3">
                        <div class="card-header pb-0">
                            <h4 class="card-title mb-0">Data Password</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row mx-0">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" id="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            placeholder="Masukkan password">
                                        @error('password')
                                            <div class=" invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation">Konfirmasi Password</label>
                                        <input type="password" id="password_confirmation" class="form-control"
                                            name="password_confirmation" placeholder="Masukkan konfirmasi password">
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                    <x-action to="user" />
                </div>

            </div>
        </form>
    </section>
@endsection
