
$(document).ready(function () {

    var formId = $('#addQualityForm');
    formId.validate({
        rules: {
            quality_name: {
                required: true,
                remote: {
                    type: 'post',
                    url: base_url+'quality/checkQualityAlredyExist',
                    data: {
                        quality_name: function () { return $('#qualityname').val(); }
                    },
                    dataType: 'json'
                },
            },
            status: {
                required: true 
            }
        },
        messages: {
            quality_name: {
                required: "Enter Quality name",
                remote: jQuery.validator.format("{0} is already taken.")
            },
            status: {
                required: "Select status" 
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler:function()
        {
            if(formId.valid() == true)
            {
                var formData = new FormData(formId[0]);

                $.ajax({
                    type: "post",
                    url: base_url+'quality/addquality',
                    dataType: "json",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#newtodo').modal('hide');
                        if (response.rs) {
                           
                            window.location = base_url + 'quality';    

                        } else {
                            (response.errType == 'v') ? formId.prepend(showAlert('Required', response.msg)): Codebase.helpers('notify', { align: 'right', from: 'top', type: 'danger', icon: 'fa fa-times mr-5', message: response.msg });
                        }

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        var $errmsg = '<p>Status code: ' + jqXHR.status + '</p><p>Error Thrown: ' + errorThrown + '</p><p>jqXHR.responseText:</p>';
                        //$errmsg = (TG.DEBUG) ? $errmsg : 'Server not responding.. '
                        // console.log($errmsg);
                        //technoNotify('', $errmsg, 'error')


                    },
                }).fail(function(jqXHR, textStatus) {
                    if (textStatus === 'timeout') {
                        console.log('Failed from timeout');
                    }
                
                });
            }
        }
    });
});

$(document).on("click", ".view_details", function() {
    var quality_id = $(this).data('id');

    $.ajax({
        type: "POST",
        url: base_url + 'quality/getdetails',
        data: { quality_id: quality_id },
        dataType: 'JSON',
        cache: false,
        success: function(data) {
            $('#quality_name').text(data.quality_name);
            $('#note').text(data.note);
            $('#status').text(data.status);
            $('#last_updated').text(data.last_updated);
            
        },
        error: function(xhr, status, error) {
            Codebase.helpers('notify', { align: 'right', from: 'top', type: 'danger', icon: 'fa fa-time mr-5', message: error });
        },

    });
});

$(document).on("click", ".get_edit_details", function() {
    var quality_id = $(this).data('id');

    $.ajax({
        type: "POST",
        url: base_url + 'quality/geteditdetails',
        data: { quality_id: quality_id },
        dataType: 'JSON',
        cache: false,
        success: function(data) {
            $('#edt_quality_name').val(data.quality_name);
            $('#edt_note').val(data.note);
            $('select[name=edt_status]').select2('val',[data.status]);
            $('#quality_id').val(data.quality_id);
            
        },
        error: function(xhr, status, error) {
            Codebase.helpers('notify', { align: 'right', from: 'top', type: 'danger', icon: 'fa fa-time mr-5', message: error });
        },

    });
});

$(document).ready(function () {

    var formId = $('#editQualityForm');
    formId.validate({
        rules: {
            edt_quality_name: {
                required: true,
                remote: {
                    type: 'post',
                    url: base_url+'quality/checkQualityAlredyExist1',
                    data: {
                        edt_quality_name: function () { return $('#edt_quality_name').val(); },
                        quality_id: function () { return $('#quality_id').val(); }
                    },
                    dataType: 'json'
                },
            },
            edt_status: {
                required: true 
            }
        },
        messages: {
            edt_quality_name: {
                required: "Enter Quality name",
                remote: jQuery.validator.format("{0} is already taken.")
            },
            edt_status: {
                required: "Select status" 
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler:function()
        {
            if(formId.valid() == true)
            {
                var formData = new FormData(formId[0]);

                $.ajax({
                    type: "post",
                    url: base_url+'quality/editquality',
                    dataType: "json",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#edittodo').modal('hide');
                        if (response.rs) {
                           
                            window.location = base_url + 'quality';    

                        } else {
                            (response.errType == 'v') ? formId.prepend(showAlert('Required', response.msg)): Codebase.helpers('notify', { align: 'right', from: 'top', type: 'danger', icon: 'fa fa-times mr-5', message: response.msg });
                        }

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        var $errmsg = '<p>Status code: ' + jqXHR.status + '</p><p>Error Thrown: ' + errorThrown + '</p><p>jqXHR.responseText:</p>';
                        //$errmsg = (TG.DEBUG) ? $errmsg : 'Server not responding.. '
                        // console.log($errmsg);
                        //technoNotify('', $errmsg, 'error')


                    },
                }).fail(function(jqXHR, textStatus) {
                    if (textStatus === 'timeout') {
                        console.log('Failed from timeout');
                    }
                
                });
            }
        }
    });
});

$(document).on("click", ".quality_delete", function() {
    var quality_id = $(this).data('id');


    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this quality!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: 'btn-danger',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: "No, cancel plx!",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function(isConfirm){
        if (isConfirm){

            $.ajax({
                type: "post",
                url: base_url + 'quality/deletequality',
                data: { quality_id: quality_id },
                dataType: 'json',
                cache: false,
                success: function(data) {

                    window.location = base_url + 'quality';
 
                },
                error: function(xhr, status, error) {
                    alert(error);
                },

            }); 
        }
        else
        {
            swal("Cancelled", "Your imaginary data is safe :)", "error");
        }     
    });

});

$(document).on("click", ".change_status", function() {
    var quality_id = $(this).data('id');


    swal({
        title: "Are you sure?",
        text: "You want to change this status?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: 'btn-danger',
        confirmButtonText: 'Yes, change it!',
        cancelButtonText: "No, cancel plx!",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function(isConfirm){
        if (isConfirm){

            $.ajax({
                type: "post",
                url: base_url + 'quality/changestatus',
                data: { quality_id: quality_id },
                dataType: 'json',
                cache: false,
                success: function(data) {

                    window.location = base_url + 'quality';
 
                },
                error: function(xhr, status, error) {
                    alert(error);
                },

            }); 
        }
        else
        {
            swal("Cancelled", "You have not made any changes", "error");
        }     
    });

});
