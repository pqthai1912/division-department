@props([
    'label',
    'name',
    'type'=>'text',
    'value' => "",

])

<label for="" class="form-label">{{ $label }}:</label>
{{-- <input type="text" name="email" class="form-control"
id="email" data-label="Email"> --}}
<input name={{ $name }} type={{ $type }} class="form-control"
id={{ $name }} placeholder="{{ $label }}" value="{{ $value }}"
data-label="{{ $label }}"
>
