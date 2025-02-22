@props([
    'label',
    'name',
    'type'=>'radio',
    'value' => '',
    'checked'=> ''
])
<div class="form-check">
    <input class="form-check-input" name={{ $name }} type={{ $type }} id={{ $name }} value="{{ $value }}"
    {{ $checked }} data-label={{ $label }}>
    <label class="form-check-label" for="{{ $name }}">
        {{ $value }}
    </label>
</div>

{{-- Copy code below to blade u want --}}
{{-- <x-inputs.radio label="First name" name="name"
        checked = {{ old('')==1 ? 'checked' : '' }}/> --}}
