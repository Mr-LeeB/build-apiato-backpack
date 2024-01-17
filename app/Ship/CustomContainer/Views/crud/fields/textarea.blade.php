<!-- textarea -->
@include('customcontainer::crud.fields.inc.wrapper_start')
<label>{!! $field['label'] !!}</label>
@include('customcontainer::crud.fields.inc.translatable_icon')
<textarea name="{{ $field['name'] }}" @include('customcontainer::crud.fields.inc.attributes')>{{ $field['value'] ?? ($field['default'] ?? '') }}</textarea>

{{-- HINT --}}
@if (isset($field['hint']))
    <p class="help-block">{!! $field['hint'] !!}</p>
@endif
@include('customcontainer::crud.fields.inc.wrapper_end')
