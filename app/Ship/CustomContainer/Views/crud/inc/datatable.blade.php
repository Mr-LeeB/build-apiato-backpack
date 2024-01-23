<script>
    // here we will check if the cached dataTables paginator length is conformable with current paginator settings.
    // datatables caches the ajax responses with pageLength in LocalStorage so when changing this
    // settings in controller users get unexpected results. To avoid that we will reset
    // the table cache when both lengths don't match.
    let $dtCachedInfo = JSON.parse(localStorage.getItem('DataTables_tableproduct_/{{ $crud->getRoute() }}')) ?
        JSON.parse(localStorage.getItem('DataTables_tableproduct_/{{ $crud->getRoute() }}')) : [];
    var $dtDefaultPageLength = 10;
    let $dtStoredPageLength = localStorage.getItem('DataTables_tableproduct_/{{ $crud->getRoute() }}_pageLength');

    if (!$dtStoredPageLength && $dtCachedInfo.length !== 0 && $dtCachedInfo.length !== $dtDefaultPageLength) {
        localStorage.removeItem('DataTables_tableproduct_/{{ $crud->getRoute() }}');
    }

    // let $dtStoredPage = localStorage.getItem('DataTables_tableproduct_/{{ $crud->getRoute() }}_page');

    var DatatableHtmlTableDemo = (function() {
        var datatable;

        var setup = function() {
            datatable = $('#tableproduct').DataTable({
                searching: true,
                paging: true,
                lengthChange: true,
                pageLength: $dtDefaultPageLength,
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                autoWidth: false,
                scrollX: true,
                fixedHeader: true,
                processing: true,
                order: [], //Initial no order.
                aaSorting: [],
                rowId: 'id',
                select: {
                    style: 'multi',
                    selector: 'td:first-child input[type="checkbox"]',
                    className: 'row-selected'
                },
                serverSide: true,
                ajax: {
                    url: "{!! url($crud->route) . '/search?' . Request::getQueryString() !!}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    error: function(xhr) {
                        console.log(xhr.status + ': ' + xhr.statusText);
                    }
                },
                columns: [{
                        data: 'id',
                    },
                    @foreach ($crud->columns as $column)
                        {
                            data: '{{ $column['name'] }}',
                            @if (isset($column['type']) && $column['type'] == 'date')
                                render: function(data, type, row) {
                                    return moment(data).format('DD/MM/YYYY')
                                },
                            @endif
                            'className': 'min-w-100px'
                        },
                    @endforeach {
                        data: null
                    },
                ],
                columnDefs: [{
                        targets: 0,
                        orderable: false,
                        render: function(_, _, data) {
                            return `
                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="${data.id}" />
                        </div>`;
                        }
                    },
                    {
                        targets: -1,
                        data: null,
                        orderable: false,
                        className: 'text-end font-weight-bold font-size-lg',
                        render: function(data, type, row) {
                            return `
                                <div class="dropdown">
                                    <button class="btn btn-light btn-active-light-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu px-1" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item btn btn-primary mb-1 d-flex justify-content-center" href="{!! url($crud->route) !!}/${data.id}/show">Show</a>
                                        <a class="dropdown-item btn btn-success mb-1 d-flex justify-content-center" href="{!! url($crud->route) !!}/${data.id}/edit">Edit</a>
                                        <a class="dropdown-item btn btn-danger d-flex justify-content-center" data-kt-docs-table-filter="delete_row" data-id="${data.id}">Delete</a>
                                    </div>
                                </div>
                            `;
                        },
                    },
                ],
                dom: "<'row hidden'<'col-sm-6'i><'col-sm-6 d-print-none'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row mt-2 d-print-none '<'col-sm-12 col-md-4'l><'col-sm-0 col-md-4 text-center'B><'col-sm-12 col-md-4 'p>>",
            });

            datatable.on('draw', function() {
                initToggleToolbar();
                toggleToolbars();
                handleDeleteRows();
            });
        }

        const handleDeleteRows = () => {
            // Select all delete buttons
            const deleteButtons = document.querySelectorAll(
                '[data-kt-docs-table-filter="delete_row"]');

            deleteButtons.forEach(d => {
                // Delete button on click
                d.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Get row name
                    const customerName = 'this Item';

                    // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                    Swal.fire({
                        text: "Are you sure you want to delete " +
                            customerName + "?",
                        icon: "warning",
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: "Yes, delete!",
                        cancelButtonText: "No, cancel",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton: "btn fw-bold btn-active-light-primary"
                        }
                    }).then(function(result) {
                        if (result.value) {
                            // Simulate delete request -- for demo purpose only
                            Swal.fire({
                                text: "Deleting " + customerName,
                                icon: "info",
                                buttonsStyling: false,
                                showConfirmButton: false,
                                timer: 1000
                            }).then(function() {
                                $.ajax({
                                    url: "{{ url($crud->route) }}/" +
                                        d.dataset.id,
                                    type: "DELETE",
                                    data: {
                                        _token: "{{ csrf_token() }}"
                                    },
                                    success: function(response) {
                                        Swal.fire({
                                            text: "You have deleted " +
                                                customerName +
                                                "!.",
                                            icon: "success",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {
                                                confirmButton: "btn fw-bold btn-primary",
                                            }
                                        }).then(function() {
                                            // delete row data from server and re-draw datatable
                                            datatable
                                                .ajax
                                                .reload();
                                        });
                                    },
                                    error: function() {
                                        Swal.fire({
                                            text: customerName +
                                                " was not deleted.",
                                            icon: "error",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {
                                                confirmButton: "btn fw-bold btn-primary",
                                            }
                                        });
                                    }
                                });
                            });
                        } else if (result.dismiss === 'cancel') {
                            Swal.fire({
                                text: customerName +
                                    " was not deleted.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            });
                        }
                    });
                })
            });
        }
        // Init toggle toolbar
        var initToggleToolbar = function() {
            // Toggle selected action toolbar
            // Select all checkboxes
            const container = document.querySelector('#tableproduct');
            const checkboxes = container.querySelectorAll('[type="checkbox"]');
            // console.log(checkboxes);

            // Select elements
            const deleteSelected = document.querySelector('[data-kt-docs-table-select="delete_selected"]');
            // console.log(deleteSelected);

            // Toggle delete selected toolbar
            checkboxes.forEach(c => {
                // Checkbox on click event
                c.addEventListener('click', function() {
                    setTimeout(function() {
                        toggleToolbars();
                    }, 50);
                });
            });

            // Deleted selected rows
            deleteSelected.addEventListener('click', function() {
                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Are you sure you want to delete selected customers?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    showLoaderOnConfirm: true,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    },
                }).then(function(result) {
                    if (result.value) {
                        // Simulate delete request -- for demo purpose only
                        Swal.fire({
                            text: "Deleting selected customers",
                            icon: "info",
                            buttonsStyling: false,
                            showConfirmButton: false,
                            timer: 1000
                        }).then(function() {
                            // Remove all selected customers
                            const selectedRowIds = Array.from(
                                document.querySelectorAll(
                                    "tbody [type='checkbox']:checked"
                                )
                            ).map((e) => {
                                return e.closest("tr").getAttribute("id");
                            });

                            // call ajax delete all selected rows
                            $.ajax({
                                url: "{{ url($crud->route) }}/bulk-delete",
                                type: "POST",
                                data: {
                                    ids: selectedRowIds,
                                    _token: "{{ csrf_token() }}"
                                },
                                success: function(response) {
                                    Swal.fire({
                                        text: "You have deleted all selected customers!.",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary",
                                        }
                                    }).then(function() {
                                        // delete row data from server and re-draw datatable
                                        datatable.ajax.reload();
                                    });
                                },
                                error: function() {
                                    Swal.fire({
                                        text: "Error deleting selected customers",
                                        icon: "error",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary",
                                        }
                                    });
                                }
                            });
                            // Remove header checked box
                            $('input[data-kt-check="true"]').prop('checked', false);
                        });
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: "Selected customers was not deleted.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        });
                    }
                });
            });
        }

        // Toggle toolbars
        var toggleToolbars = function() {
            // Define variables
            const container = document.querySelector('#tableproduct');
            const toolbarBase = document.querySelector('[data-kt-docs-table-toolbar="base"]');
            const toolbarSelected = document.querySelector('[data-kt-docs-table-toolbar="selected"]');
            const selectedCount = document.querySelector('[data-kt-docs-table-select="selected_count"]');

            // Select refreshed checkbox DOM elements
            const allCheckboxes = container.querySelectorAll('tbody [type="checkbox"]');

            // Detect checkboxes state & count
            let checkedState = false;
            let count = 0;

            // Count checked boxes
            allCheckboxes.forEach(c => {
                if (c.checked) {
                    checkedState = true;
                    count++;
                }
            });

            // Toggle toolbars
            if (checkedState) {
                selectedCount.innerHTML = count;
                toolbarBase.classList.add('d-none');
                toolbarSelected.classList.remove('d-none');
            } else {
                toolbarBase.classList.remove('d-none');
                toolbarSelected.classList.add('d-none');
            }
        }

        return {
            init: function() {
                setup();
                initToggleToolbar();

                handleDeleteRows();
                // Re-init functions on every datatable reload
                $('input[data-kt-check="true"]').change(function() {
                    // When it changes, set the checked property of all checkboxes in the table to match its checked property
                    $('#tableproduct .form-check-input').prop('checked', $(this).prop('checked'));

                    // Then update the toolbar
                    setTimeout(function() {
                        toggleToolbars();
                    }, 50);
                });
            }
        };
    })();
    $(document).ready(function() {
        DatatableHtmlTableDemo.init();

        $('[data-action-create-item]').click(function() {
            var baseUrl = window.location.origin;
            var actionPath = $(this).data('action-create-item');
            window.location.href = baseUrl + '/' + actionPath;
        });


        // create the reset button
        var crudTableResetButton =
            `<a href="{{ url($crud->route) }}" class="ml-1" id="crudTable_reset_button">
                <i class="flaticon2-reload cursor-pointer reset_params" data-toggle="tooltip" title="Reset" />
            </a> `;

        $('#datatable_info_stack').append(crudTableResetButton);

        // when clicking in reset button we clear the localStorage for datatables.
        $('#crudTable_reset_button').on('click', function() {

            //clear the filters
            if (localStorage.getItem('{{ Str::slug($crud->getRoute()) }}_list_url')) {
                localStorage.removeItem('{{ Str::slug($crud->getRoute()) }}_list_url');
            }
            if (localStorage.getItem('{{ Str::slug($crud->getRoute()) }}_list_url_time')) {
                localStorage.removeItem('{{ Str::slug($crud->getRoute()) }}_list_url_time');
            }

            //clear the table sorting/ordering/visibility
            if (localStorage.getItem('DataTables_tableproduct_/{{ $crud->getRoute() }}')) {
                localStorage.removeItem('DataTables_tableproduct_/{{ $crud->getRoute() }}');
            }
        });

        // make sure AJAX requests include XSRF token
        $.ajaxPrefilter(function(options, originalOptions, xhr) {
            var token = $('meta[name="csrf_token"]').attr('content');
            if (token) {
                return xhr.setRequestHeader('X-XSRF-TOKEN', token);
            }
        });
    });
</script>
