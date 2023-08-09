 $(document).ready(function() {
    var formId = $('#addModelForm');
    $('#addModelForm').validate({
        rules: {
            model: {
                required: true,
                remote: {
                    type: 'post',
                    url: base_url+'model_name/checkModelAlredyExist',
                    data: {
                        model: function () { return $('#model').val(); }
                    },
                    dataType: 'json'
                },
            } 
        },
        messages: {
            model: {
                required: "Enter Model name",
                remote: jQuery.validator.format("{0} is already taken.")
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
        submitHandler:function() {
            var formData = new FormData(formId[0]);
            $.ajax({
                type: "POST",
                url: base_url + 'model_name/add_model',
                data: formData,
                dataType: "JSON",
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.rs) {
                       
                        window.location = base_url + 'model_name';    

                    } else {
                        (response.errType == 'v') ? formId.prepend(showAlert('Required', response.msg)): Codebase.helpers('notify', { align: 'right', from: 'top', type: 'danger', icon: 'fa fa-times mr-5', message: response.msg });
                    }

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    var $errmsg = '<p>Status code: ' + jqXHR.status + '</p><p>Error Thrown: ' + errorThrown + '</p><p>jqXHR.responseText:</p>';
 
                },
            }).fail(function(jqXHR, textStatus) {
                if (textStatus === 'timeout') {
                    console.log('Failed from timeout');
                }
            
            });
        }   
    });
});

$(document).ready(function () {

    var formId = $('#editModelForm');
    formId.validate({
        rules: {
            model: {
                required: true,
                remote: {
                    type: 'post',
                    url: base_url+'model_name/checkModelAlredyExist',
                    data: {
                        model: function () { return $('#model').val(); },
                        model_id: function () { return $('#model_id').val(); }
                    },
                    dataType: 'json'
                },
            } 
        },
        messages: {
            model: {
                required: "Enter Model name",
                remote: jQuery.validator.format("{0} is already taken.")
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
                    type: "POST",
                    url: base_url + 'model_name/updatemodel',
                    data: formData,
                    dataType: "JSON",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.rs) {
                           
                            window.location = base_url + 'model_name';    

                        } else {
                            (response.errType == 'v') ? formId.prepend(showAlert('Required', response.msg)): Codebase.helpers('notify', { align: 'right', from: 'top', type: 'danger', icon: 'fa fa-times mr-5', message: response.msg });
                        }

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        var $errmsg = '<p>Status code: ' + jqXHR.status + '</p><p>Error Thrown: ' + errorThrown + '</p><p>jqXHR.responseText:</p>';
     
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

$(document).on("click", ".model_delete", function() {
    var model_id = $(this).data('id');


    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this Model!",
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
                url: base_url + 'model_name/deletemodel',
                data: { model_id: model_id },
                dataType: 'json',
                cache: false,
                success: function(data) {

                    window.location = base_url + 'model_name';
 
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