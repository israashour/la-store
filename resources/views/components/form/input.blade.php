@props([
    'name', 'value' => '', 'label', 'placeholder', 'type' => 'text'
])


<input type="{{ $type ?? 'text'}}"
name="{{ $name }}"
placeholder="{{ $placeholder ?? '' }}"
value="{{ old($name, $value) }}"
{{ $attributes->class([
    'form-control',
    'is-invalid' => $errors->has($name)
])}}>
@error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror
