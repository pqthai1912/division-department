@props([
    'label',
    'name',
    'value' => "",
    'options',
    'disabled' => false
])
<div class="input-group">
    <label class="input-group-text" >{{ $label }}</label>
    <select class="form-select" name="{{ $name }}" id="{{ $name }}"
    data-label="{{ $label }}" @if($disabled) disabled @endif>
        <option value="">Choose...</option>
        @foreach ($options as $value_select => $label_select)
            <option value="{{ $value_select }}"
                {{ ((int) $value === $value_select and $value != "") ? 'selected' : '' }}>
                {{ $label_select }}
            </option>
        @endforeach
    </select>
</div>

{{-- <x-label-select name="" label="" :options="$options" /> --}}

