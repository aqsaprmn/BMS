<label for="{{ $identity }}">{{ $label }} {!! $require ? '<sup>*</sup>' : '' !!}
</label>
<input {{ $require ? 'required' : '' }} class="form-control img-preview @error("$identity") is-invalid @enderror"
    type="file" id="{{ $identity }}" name="{{ $identity }}">
@error("$identity")
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror
<div class="border border-1 mt-3 rounded-2 p-2">
    <div style="width: 200px" class="position-relative m-auto">
        <img id="{{ $image }}" class="w-100 h-100 rounded-2"
            src="{{ $src != '' ? asset('storage/uploads/customer/' . Str::camel($identity) . '/' . $src) : asset('assets/images/logo/noimage.png') }}"
            alt="{{ $label }}">
    </div>
</div>

@push('scripts')
    <script>
        $(function() {
            $("#{{ $identity }}").change(function() {

                const prevImage = $("#{{ $image }}");

                const oFReader = new FileReader();

                oFReader.readAsDataURL(this.files[0]);

                oFReader.onload = function(oFREvent) {
                    prevImage.attr("src", oFREvent.target.result);
                }
            })
        });
    </script>
@endpush
