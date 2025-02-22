@props([
    'value',
    'type' => 'submit'
])
<button id="btnSubmit" type={{ $type }} {{ $attributes }}>
    {{ $value }}
</button>

{{-- Copy code below to blade u want --}}
{{-- <x-button class="btn btn-primary" value="Create" /> --}}
