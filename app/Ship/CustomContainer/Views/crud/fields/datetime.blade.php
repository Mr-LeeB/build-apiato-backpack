<!-- html5 datetime input -->

@php
// if the column has been cast to Carbon or Date (using attribute casting)
// get the value as a date string
if (isset($field['value']) && ($field['value'] instanceof \Carbon\CarbonInterface)) {
    $field['value'] = $field['value']->toDateTimeString();
}

$timestamp = strtotime(old(square_brackets_to_dots($field['name'])) ? old(square_brackets_to_dots($field['name'])) : (isset($field['value']) ? $field['value'] : (isset($field['default']) ? $field['default'] : '' )));

$value = $timestamp ? date('Y-m-d\TH:i:s', $timestamp) : '';
@endphp

@include('customcontainer::crud.fields.inc.wrapper_start')
    <label>{!! $field['label'] !!}</label>
    @include('customcontainer::crud.fields.inc.translatable_icon')
    <input
        type="datetime-local"
        name="{{ $field['name'] }}"
        value="{{ $value }}"
        @include('customcontainer::crud.fields.inc.attributes')
        >

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
@include('customcontainer::crud.fields.inc.wrapper_end')
