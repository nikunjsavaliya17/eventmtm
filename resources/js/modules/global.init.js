import moment from "moment/min/moment.min";

window.moment = moment;
import 'bootstrap/js/dist/popover';

$(function () {

    $('.deleteRecord').on('click', function () {
        $("#deleteModalForm").attr('action', $(this).data('action_url'))
        $("#delete_record_id").val($(this).data('record_id'))
        $("#delete-record-modal").modal('show');
    });

    $('.displayOrder').on('change', function () {
        let $display_order_record_id = $(this).data('record_id');
        let $display_order_update_url = $(this).data('action_url');
        let $display_order = $(this).val();
        if ($display_order < 0){
            $display_order = 0;
            $(this).val($display_order);
        }
        if ($display_order > 0){
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: $display_order_update_url,
                data: {display_order: $display_order,record_id:$display_order_record_id},
                beforeSend: function () {

                },
                success: function (data) {

                }
            });
        }
    });
});
