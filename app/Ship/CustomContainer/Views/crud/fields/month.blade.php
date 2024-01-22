<!-- html5 month input -->
@include('customcontainer::crud.fields.inc.wrapper_start')
<label>{!! $field['label'] !!}</label>
@include('customcontainer::crud.fields.inc.translatable_icon')
<input type="month" name="{{ $field['name'] }}" value="{{ $field['value'] ?? ($field['default'] ?? '') }}"
    @include('customcontainer::crud.fields.inc.attributes')>

{{-- HINT --}}
@if (isset($field['hint']))
    <p class="help-block">{!! $field['hint'] !!}</p>
@endif
@include('customcontainer::crud.fields.inc.wrapper_end')
