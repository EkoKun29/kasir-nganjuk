@if (isset($label))
    <div class="mb-3">
        <label for="Input" class="form-label">{{ $label }}</label>
        <select id="select2" class="form-control " name="{{ $name }}"
            data-dropdown-parent="{{ $ddp ?? '#createModal' }}" id="selectInput">
            <option selected disabled>Pilih {{ $label }}</option>
            {{-- Cek Apakah Sebuah Array atau tidak --}}
            @if ($isArray == '')
                @foreach ($_data as $d)
                    <option value="{{ $d->$_item }}" {{ $d->$_item == ($selected ?? '') ? 'selected' : '' }}>
                        {{ $d->$_item }}
                    </option>
                @endforeach
            @else
                @foreach ($_data as $d)
                    <option value="{{ $d[$_item] }}" {{ $d[$_item] == ($selected ?? '') ? 'selected' : '' }}>
                        {{ $d[$_item] }}</option>
                @endforeach
            @endif
        </select>
    </div>
@else
    <select id="select2" class="form-control " name="{{ $name }}" id="selectInput">
        {{-- Cek Apakah Sebuah Array atau tidak --}}
        @if ($isArray == '')
            @foreach ($_data as $d)
                <option value="{{ $d->$_item }}" {{ $d->$_item == ($selected ?? '') ? 'selected' : '' }}>
                    {{ $d->$_item }}
                </option>
            @endforeach
        @else
            @foreach ($_data as $d)
                <option value="{{ $d[$_item] }}" {{ $d[$_item] == ($selected ?? '') ? 'selected' : '' }}>
                    {{ $d[$_item] }}</option>
            @endforeach
        @endif
    </select>
@endif
