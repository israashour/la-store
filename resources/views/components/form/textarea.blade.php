@props([
    'name', 'value' => '', 'label' => false, 'placeholder'
])



<textarea
    name="{{ $name }}"
    placeholder="{{ $placeholder }}"
    @class([
        'form-control',
        'is-invalid' => $errors->has($name)
    ])
>{{ old($name, $value) }}</textarea>
@error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror
