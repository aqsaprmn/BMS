<label for="{{ $identity }}">{{ $label }} {!! $require ? '<sup>*</sup>' : '' !!}
</label>
<select class="form-select @error("$identity") is-invalid @enderror " name="{{ $identity }}" id="{{ $identity }}">
    <option></option>

    @foreach ($row as $r)
        {{-- @php
            $p = '';
            is_array($r) ? ($p = (object) $r) : ($p = $r);
        @endphp --}}

        @if ($integration != '' && !empty($custom))
            @php
                if (Str::of($custom->id)->contains('!')) {
                    $text = Str::of($custom->id)->after('!');
                
                    $id = $r->$integration->$text;
                } else {
                    $text = $custom->id;
                
                    $id = $r->$text;
                }
                
                $desc = '';
                
                if (is_array($custom->desc)) {
                    if (count($custom->desc) > 1) {
                        foreach ($custom->desc as $key => $value) {
                            if (Str::of($value)->contains('!')) {
                                $d = Str::of($value)->after('!');
                
                                $desc .= $r->$integration->$d;
                            } else {
                                $desc .= $r->$value;
                            }
                
                            if (count($custom->desc) - 1 != $key) {
                                $desc .= ' - ';
                            }
                        }
                    } else {
                        $d = $custom->desc[0];
                
                        $desc = $r->$d;
                    }
                } else {
                    $d = $custom->desc;
                
                    $desc = $r->$d;
                }
                
            @endphp
            <option {{ $select == $id ? 'selected' : '' }}
                {{ $id == ($field == '' ? old("$identity") : $field) ? 'selected' : '' }} value="{{ $id }}">
                {{ $desc }}
            </option>
        @else
            <option {{ $select == $r->$match ? 'selected' : '' }}
                {{ $r->$match == ($field == '' ? old("$match") : $field) ? 'selected' : '' }}
                value="{{ $r->$match }}">
                {{ $r->desc }}
            </option>
        @endif
    @endforeach
</select>

@error("$identity")
    <div class=" invalid-feedback">
        {{ $message }}
    </div>
@enderror
@push('scripts')
    <script>
        $(document).ready(function() {
            $("#{{ $identity }}").select2({
                placeholder: "{{ $optionFirst }}",
            });
            $("span.select2").css('fontSize', "100%");

            $("span.select2 span.select2-selection").css('height', "auto");
            $("span.select2 span.select2-selection").css('borderColor', "#dce7f1");

            $("span.select2 span.select2-selection__rendered").css('padding', "6px 20px 6px 12px");
            $("span.select2 span.select2-selection__rendered").css('lineHeight', "1.5");
            $("span.select2 span.select2-selection__rendered").css('color', "#607080");

            $("span.select2 span.select2-selection__arrow").css('top', "4px");

            $("span.select2").css('width', "100%");
        });
    </script>
@endpush
