<!-- text input -->
@include('customcontainer::crud.fields.inc.wrapper_start')
<label>{!! $field['label'] !!}</label>
@include('customcontainer::crud.fields.inc.translatable_icon')

@if (isset($field['prefix']) || isset($field['suffix']))
    <div class="input-group">
@endif
@if (isset($field['prefix']))
    <div class="input-group-prepend"><span class="input-group-text">{!! $field['prefix'] !!}</span></div>
@endif
<input type="text" name="{{ $field['name'] }}" value="{{ $field['value'] ?? ($field['default'] ?? '') }}"
    @include('customcontainer::crud.fields.inc.attributes')>
@if (isset($field['suffix']))
    <div class="input-group-append"><span class="input-group-text">{!! $field['suffix'] !!}</span></div>
@endif
@if (isset($field['prefix']) || isset($field['suffix']))
    </div>
@endif

{{-- HINT --}}
@if (isset($field['hint']))
    <p class="help-block">{!! $field['hint'] !!}</p>
@endif
@include('customcontainer::crud.fields.inc.wrapper_end')
