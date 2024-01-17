<!-- html5 date input -->

<?php
// if the column has been cast to Carbon or Date (using attribute casting)
// get the value as a date string
if (isset($field['value']) && $field['value'] instanceof \Carbon\CarbonInterface) {
    $field['value'] = $field['value']->toDateString();
}
?>

@include('customcontainer::crud.fields.inc.wrapper_start')
<label>{!! $field['label'] !!}</label>
@include('customcontainer::crud.fields.inc.translatable_icon')
<input type="date" name="{{ $field['name'] }}" value="{{ $field['value'] ?? ($field['default'] ?? '') }}"
    @include('customcontainer::crud.fields.inc.attributes')>

{{-- HINT --}}
@if (isset($field['hint']))
    <p class="help-block">{!! $field['hint'] !!}</p>
@endif
@include('customcontainer::crud.fields.inc.wrapper_end')
