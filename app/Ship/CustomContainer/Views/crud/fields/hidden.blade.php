@php
    // if not otherwise specified, the hidden input should take up no space in the form
    $field['wrapper'] = $field['wrapper'] ?? ($field['wrapperAttributes'] ?? []);
    $field['wrapper']['class'] = $field['wrapper']['class'] ?? 'hidden';
@endphp

<!-- hidden input -->
@include('customcontainer::crud.fields.inc.wrapper_start')
<input type="hidden" name="{{ $field['name'] }}" value="{{ $field['value'] ?? ($field['default'] ?? '') }}"
    @include('customcontainer::crud.fields.inc.attributes')>
@include('customcontainer::crud.fields.inc.wrapper_end')
