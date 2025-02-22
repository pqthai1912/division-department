@props([
    'label',
    'name',
    'type'=>'text',
    'value' => '',
    'placeholder' => '',
    'disabled' => false
])
<div class="input-group">
    <label class="input-group-text">{{ $label }}</label>
    <input name="{{ $name }}" type="{{ $type }}" class="form-control"
    id="{{ $name }}" placeholder="{{ $placeholder }}" value="{{ $value }}"
    data-label="{{ $label }}" @if($disabled) disabled @endif
    >
</div>

{{-- Copy code below to blade u want --}}
{{-- <x-inputs.text label="First name" placeholder="First name" name="name"/> --}}


