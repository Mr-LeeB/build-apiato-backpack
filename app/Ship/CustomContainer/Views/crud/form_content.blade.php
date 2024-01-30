<input type="hidden" name="http_referrer"
    value={{ session('referrer_url_override') ?? (old('http_referrer') ?? (\URL::previous() ?? url($crud->route))) }}>

{{-- See if we're using tabs --}}

<div class="card">
    <div class="card-body row">
        @include('customcontainer::crud.inc.show_fields', ['fields' => $crud->fields()])
    </div>
</div>


{{-- Define blade stacks so css and js can be pushed from the fields to these sections. --}}

@section('css')
    {{-- <link rel="stylesheet"
        href="{{ asset('packages/backpack/crud/css/crud.css') . '?v=' . config('backpack.base.cachebusting_string') }}">
    <link rel="stylesheet"
        href="{{ asset('packages/backpack/crud/css/form.css') . '?v=' . config('backpack.base.cachebusting_string') }}">
    <link rel="stylesheet"
        href="{{ asset('packages/backpack/crud/css/' . $action . '.css') . '?v=' . config('backpack.base.cachebusting_string') }}"> --}}

    <!-- CRUD FORM CONTENT - crud_fields_styles stack -->
    @stack('crud_fields_styles')

    {{-- Temporary fix on 4.1 --}}
    <style>
        .form-group.required label:not(:empty):not(.form-check-label)::after {
            content: '';
        }

        .form-group.required>label:not(:empty):not(.form-check-label)::after {
            content: ' *';
            color: #ff0000;
        }
    </style>
@endsection

@section('after_scripts')
    {{-- <script src="{{ asset('packages/backpack/crud/js/crud.js') . '?v=' . config('backpack.base.cachebusting_string') }}">
    </script>
    <script src="{{ asset('packages/backpack/crud/js/form.js') . '?v=' . config('backpack.base.cachebusting_string') }}">
    </script>
    <script src="{{ asset('packages/backpack/crud/js/' . $action . '.js') . '?v=' . config('backpack.base.cachebusting_string') }}">
    </script> --}}

    <!-- CRUD FORM CONTENT - crud_fields_scripts stack -->
    @stack('crud_fields_scripts')

    <script>
        function initializeFieldsWithJavascript(container) {
            var selector;
            if (container instanceof jQuery) {
                selector = container;
            } else {
                selector = $(container);
            }
            selector.find("[data-init-function]").not("[data-initialized=true]").each(function() {
                var element = $(this);
                var functionName = element.data('init-function');

                if (typeof window[functionName] === "function") {
                    window[functionName](element);

                    // mark the element as initialized, so that its function is never called again
                    element.attr('data-initialized', 'true');
                }
            });
        }

        jQuery('document').ready(function($) {

            // trigger the javascript for all fields that have their js defined in a separate method
            initializeFieldsWithJavascript('form');


            // Save button has multiple actions: save and exit, save and edit, save and new
            var saveActions = $('#saveActions'),
                crudForm = saveActions.parents('form'),
                saveActionField = $('[name="save_action"]');

            saveActions.on('click', '.dropdown-menu a', function() {
                var saveAction = $(this).data('value');
                saveActionField.val(saveAction);
                crudForm.submit();
            });

            // Ctrl+S and Cmd+S trigger Save button click
            $(document).keydown(function(e) {
                if ((e.which == '115' || e.which == '83') && (e.ctrlKey || e.metaKey)) {
                    e.preventDefault();
                    $("button[type=submit]").trigger('click');
                    return false;
                }
                return true;
            });

            // prevent duplicate entries on double-clicking the submit form
            crudForm.submit(function(event) {
                $("button[type=submit]").prop('disabled', true);
            });



            $("a[data-toggle='tab']").click(function() {
                currentTabName = $(this).attr('tab_name');
                $("input[name='current_tab']").val(currentTabName);
            });

            if (window.location.hash) {
                $("input[name='current_tab']").val(window.location.hash.substr(1));
            }

        });
    </script>
@endsection
