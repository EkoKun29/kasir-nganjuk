@if (isset($label))
    <div class="mb-3">
        <label for="Input" class="form-label">{{ $label }}</label>
        <input type="{{ $type ?? 'text' }}" class="form-control" name="{{ $name }}" value="{{ $value ?? '' }}"
            required {{ $attr ?? '' }}>
    </div>
@else
    <input type="{{ $type ?? 'text' }}" class="form-control" name="{{ $name }}" value="{{ $value ?? '' }}"
        required {{ $attr ?? '' }}>
@endif
