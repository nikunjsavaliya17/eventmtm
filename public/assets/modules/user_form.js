$(document).ready(function () {
    $("#userForm").validate({
        rules: {
            'personal_details[mobile_number]': {
                required: true,
                required: true,
                remote: {
                    url: $app_url+ '/users/validate-unique',
                    type: "post",
                    data: {
                        mobile_number: function () {
                            return $("input[name='personal_details[mobile_number]']").val();
                        },
                        id: $("#user_id").val()
                    },
                    dataFilter: function (data) {
                        var json = JSON.parse(data);
                        if (json.validate_status) {
                            return 'true';
                        } else {
                            return "\"" + "Mobile number already in use!" + "\"";
                        }
                    }
                }
            }
        }
    });

    $('.dropifyImage').dropify();

    $(document).on('change', '#userHasBusinessDetails', function (){
        $("#userHasBusinessDetailsDiv").toggle(this.checked);
    });

    $(document).on('change', '.defaultImageFlag', function (){
        $(".defaultImageFlag").prop('checked', false);
        $(this).prop('checked', true);
    });

    $('#personal-details').repeater({
        show: function () {
            $(this).slideDown();
            // Feather Icons
            if (feather) {
                feather.replace({width: 14, height: 14});
            }
            $(this).find('.defaultImageFlag').prop('checked', false);
            $(this).find('.cloneProfileDropifyImage').attr('required', true);
            $(this).find('.cloneProfileDropifyImage').removeAttr('data-default-file');
            $(this).find('.cloneProfileDropifyImage').dropify();
            $(this).find('.addNewBtn').remove();
        },
        hide: function (deleteElement) {
            if($(this).find('.defaultImageFlag').is(':checked')){
                $('.defaultImageFlag:first').prop('checked', true);
            }
            $(this).slideUp(deleteElement);
        },
        ready: function () {
            $('.cloneProfileDropifyImage').dropify();
        },
        isFirstItemUndeletable: true
    });

    $('#business-details').repeater({
        show: function () {
            $(this).slideDown();
            // Feather Icons
            if (feather) {
                feather.replace({width: 14, height: 14});
            }
            $(this).find('.cloneProductDropifyImage').attr('required', true);
            $(this).find('.cloneProductDropifyImage').removeAttr('data-default-file');
            $(this).find('.cloneProductDropifyImage').dropify();
        },
        hide: function (deleteElement) {
            $(this).slideUp(deleteElement);
        },
        ready: function () {
            $('.cloneProductDropifyImage').dropify();
        },
        initEmpty: (productImagesCount == 0)
    });

    var horizontalWizard = document.querySelector('.horizontal-wizard-example');
    var numberedStepper = new Stepper(horizontalWizard);

    $(horizontalWizard)
        .find('.btn-next')
        .each(function () {
            $(this).on('click', function (e) {
                var isValid = $("#userForm").valid();
                if (isValid) {
                    numberedStepper.next();
                      $('html, body').animate({
                          scrollTop: $(".content-wrapper").offset().top
                      }, 300);
                } else {
                    e.preventDefault();
                }
            });
        });

    $(horizontalWizard)
        .find('.btn-prev')
        .on('click', function () {
            numberedStepper.previous();
              $('html, body').animate({
                  scrollTop: $(".content-wrapper").offset().top
              }, 300);
        });

    $(horizontalWizard)
        .find('.btn-submit')
        .on('click', function () {
            var isValid = $("#userForm").valid();
              if (isValid) {
                    $("#userForm").submit();
              }
        });
});
