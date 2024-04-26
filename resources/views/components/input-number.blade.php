<label for="{{ $identity }}">{{ $label }} {!! $require ? '<sup>*</sup>' : '' !!}</label>
<input min="1" type="text" id="{{ $identity }}"
    class="form-control number @error($identity) is-invalid @enderror" name="{{ $identity }}"
    placeholder="{{ $placeholder }}" value="{{ old("$identity", $value) }}" {{ $require ? 'required' : '' }}
    {{ $autoComplete ? 'autocomplete="off"' : '' }}>
@error($identity)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror

@push('scripts')
    <script>
        $(function() {
            $('.number').keypress(validNumber);

            let ignoreMin = {{ $ignoreMin == 1 ? 1 : 0 }};
            ignoreMin = ignoreMin ? true : false;

            function validNumber(e) {
                const key = e.which;

                if (!ignoreMin) {
                    if (key == 45) {
                        return true;
                    }

                    key == 45 ? true : false;
                }

                if (key >= 48 && key <= 57 || key == 43 || key == 32) {
                    return true;
                }

                return false;
            }
        })
    </script>
@endpush
