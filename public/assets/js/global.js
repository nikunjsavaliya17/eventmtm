$(window).on('load', function () {
    if (feather) {
        feather.replace({
            width: 14,
            height: 14
        });
    }

    $("form").submit(function () {
        if ($(this).valid()){
            blockUIEnable();
        }
    });

    if ($('.dataTables_filter').length){
        // Filter form control to default size for all tables
        $('.dataTables_filter .form-control').removeClass('form-control-sm');
        $('.dataTables_length .form-select').removeClass('form-select-sm').removeClass('form-control-sm');
    }

    if ($('.generalDatatable').length) {
        $(".generalDatatable").DataTable({
            "aaSorting": [],
            "drawCallback": function () {
                if (feather) {
                    feather.replace({
                        width: 14,
                        height: 14
                    });
                }
            },
        });
    }

    if ($('.select2').length) {
        var $select2Input = $('.select2');
        $select2Input.wrap('<div class="position-relative"></div>');
        $select2Input.select2({
            placeholder: '--SELECT--',
            dropdownAutoWidth: true,
            allowClear: true,
            width: '100%',
            dropdownParent: $select2Input.parent()
        }).change(function () {
            $(this).valid();
        });
    }
})

function confirmDelete(deleteFormId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-outline-danger ms-1'
        },
        buttonsStyling: false
    }).then(function (result) {
        if (result.value) {
            blockUIEnable();
            $('#'+deleteFormId).submit();
        }
    });
}

function blockUIEnable() {
    $.blockUI({
        message:
            '<div class="d-flex justify-content-center align-items-center"><p class="me-50 mb-0">Please wait...</p> <div class="spinner-grow spinner-grow-sm text-white" role="status"></div> </div>',
        css: {
            backgroundColor: 'transparent',
            color: '#fff',
            border: '0'
        },
        overlayCSS: {
            opacity: 0.5
        }
    });
}

function blockUIDisable() {
    $.unblockUI();
}
