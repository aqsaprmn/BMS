@extends('Layout.main')

@section('heading')
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>{{ $title }}</h3>
            <p class="text-subtitle text-muted">Untuk pengguna melihat/memperbarui data pribadi</p>
        </div>

    </div>
@endsection

@section('content')
    <section id="multiple-column-form">
        <form class="form" action="{{ url('profile') }}/{{ auth()->user()->user_id }}" method="post"
            enctype="multipart/form-data">
            @method('patch')
            @csrf
            <div class="row match-height">
                <div class="row mx-0">
                    <div class="col md-6 ps-0 pe-md-2 pe-0">
                        <div class="card mb-3 p-0">
                            <div class="card-header pb-0">
                                <h4 class="card-title mb-0">Data Status</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-lg-0 mb-4 d-flex justify-content-center">

                                            <div class="avatar-upload">
                                                <div class="avatar-edit">
                                                    <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                                                    <label for="imageUpload">
                                                    </label>
                                                </div>
                                                <div class="avatar-preview">
                                                    <div id="imagePreview"
                                                        style="background-image: url({{ url('storage/uploads/user') }}/{{ auth()->user()->image }});">
                                                    </div>
                                                </div>
                                            </div>
                                            @error('image')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <div class="modal" id="modalImage" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Sesuaikan Foto Profil</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div id="image_demo"></div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button id="simpanProfil" type="button"
                                                                class="btn btn-primary">Save Profil
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 d-flex flex-column justify-content-center">
                                            <div class="form-group">
                                                <label for="">Peran</label>
                                                <input disabled type="text" class="form-control"
                                                    value="{{ auth()->user()->role }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Jabatan</label>
                                                <input disabled type="text" class="form-control"
                                                    value="{{ auth()->user()->position }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 pe-0 ps-0 ps-md-2">
                        <div class="card mb-3 p-0">
                            <div class="card-header pb-0">
                                <h4 class="card-title mb-0">Data Pengguna</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="name">Nama <sup>*</sup></label>
                                            <input type="text" id="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Masukkan nama" name="name"
                                                value="{{ old('name', auth()->user()->name) }}">
                                            @error('name')
                                                <div class=" invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="">Email <sup>*</sup></label>
                                            <input type="email" id="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Masukkan email"
                                                value="{{ old('email', auth()->user()->email) }}">
                                            @error('email')
                                                <div class=" invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <x-input-number label="Handphone" identity="hp"
                                                placeholder="Masukkan handphone" :require="false" :value="auth()->user()->hp" />
                                        </div>
                                        <div class="form-group">
                                            <label for="">Password</label>
                                            <div class="password-eyes">
                                                <input type="password" value="{{ auth()->user()->passwordable }}"
                                                    class="form-control" autocomplete="off" disabled>
                                                <span class="icon-mid bi bi-eye eyes"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <x-action action="Update" to="{{ !auth()->user()->is_admin ? url('customer') : url('dashboard') }}" />
            </div>
        </form>
    </section>
@endsection

@push('scripts')
    <script id="rendered-js">
        function readURL(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $image_crop.croppie("bind", {
                        url: e.target.result
                    }).then((result) => {
                        console.log(result);
                    }).catch((err) => {
                        console.log(err);
                    });
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).ready(function() {

            $image_crop = $("#image_demo").croppie({
                enableExif: true,
                viewport: {
                    width: 200,
                    height: 200,
                    type: 'circle'
                },
                boundary: {
                    width: 300,
                    height: 300
                }
            })

            $("#imageUpload").on("change", function() {
                readURL(this);
                $("#modalImage").modal("show");
            });

            $("#simpanProfil").on("click", function(e) {
                $image_crop.croppie("result", {
                    type: "canvas",
                    size: "viewport"
                }).then((result) => {

                    const data = {
                        user_id: "{{ auth()->user()->user_id }}",
                        image: result,
                        _token: "{{ csrf_token() }}",
                    };

                    $.ajax({
                        type: "post",
                        url: "{{ route('uploadProfile') }}",
                        data,
                        success: function(response) {
                            if (response.result == "success") {
                                Swal.fire({
                                    title: "Ganti Poto Profil",
                                    text: response.message,
                                    icon: "success"
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        $("#modalImage").modal("hide");
                                    }

                                    $("#modalImage").modal("hide");
                                })
                                // console.log($("#imagePreview"));

                                $("#imagePreview").css("background-image",
                                    `url({{ url('public/${response.data.file_full_path}') }})`
                                )

                                $("#avatar-topbar img").attr("src",
                                    `{{ url('public/${response.data.file_full_path}') }}`
                                )
                            }
                        },
                        error: function(res, status, error) {
                            Swal.fire({
                                title: "Ganti Poto Profil",
                                text: res.message,
                                icon: "error"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $("#modalImage").modal("hide");
                                }

                                $("#modalImage").modal("hide");
                            })
                        }
                    });
                })
            })
        });
    </script>
@endpush
