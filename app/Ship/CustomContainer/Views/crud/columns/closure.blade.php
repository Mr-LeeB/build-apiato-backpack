{{-- closure function column type --}}
@php
    $column['escaped'] = $column['escaped'] ?? false;
    $column['text'] = $column['function']($entry);
    $column['prefix'] = $column['prefix'] ?? '';
    $column['suffix'] = $column['suffix'] ?? '';

    if (!empty($column['text'])) {
        $column['text'] = $column['prefix'] . $column['text'] . $column['suffix'];
    }
@endphp

<span>
    @includeWhen(!empty($column['wrapper']), 'customcontainer::crud.columns.inc.wrapper_start')
    @if ($column['escaped'])
        {{ $column['text'] }}
    @else
        {!! $column['text'] !!}
    @endif
    @includeWhen(!empty($column['wrapper']), 'customcontainer::crud.columns.inc.wrapper_end')
</span>
