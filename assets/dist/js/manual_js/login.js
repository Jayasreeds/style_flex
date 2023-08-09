
$(document).ready(function () {

    var formId = $('#loginForm');
    formId.validate({
        rules: {
            username: {
                required: true
            },
            password: {
                required: true,
                minlength: 5
            } 
        },
        messages: {
            username: {
                required: "Please enter a username"
            },
            password: {
                required: "Please provide a password",
                minlength: "Your password must be atleast 5 characters long"
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
                    url: base_url+'login/login_data',
                    dataType: "json",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success:function(data)
                    {
                        if (data.result == true) {
                            $('#submit').attr('disabled','true');
                            toastr.success(
                                'Success!',
                                data.msg,
                                {
                                    timeOut: 1000,
                                    fadeOut: 1000,
                                    closeButton:true,
                                    onHidden: function () {
                                        window.location.href = base_url+'dashboard';
                                    }
                                }
                            );

                        } else {
                            if(data.errType == 'error')
                            {
                                toastr.error(data.msg, 'Error!',{
                                    closeButton:true
                                });
                            }
                            else
                            {
                                toastr.error(data.msg, 'Error!',{
                                    closeButton:true
                                });
                            }
                                
                        }
                            
                    }
                });
            }
        }
    });
});

 
$(document).ready(function () {

    var formId = $('#forgotForm');
    formId.validate({
        rules: {
            email: {
                required: true,
                email: true
            } 
        },
        messages: {
            email: {
                required: "Please enter email",
                email: "Please enter valid email"
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
                    url: base_url+'login/forgot_data',
                    dataType: "json",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success:function(data)
                    {
                        if (data.result == true) {
                            
                            toastr.success(
                                'Success!',
                                data.msg,
                                {
                                    timeOut: 2000,
                                    fadeOut: 2000,
                                    closeButton:true,
                                    onHidden: function () {
                                        window.location.href = base_url+'login';
                                    }
                                }
                            );

                        } else {
                            if(data.errType == 'error')
                            {
                                toastr.error(data.msg, 'Error!',{
                                    closeButton:true
                                });
                            }
                            else
                            {
                                toastr.error(data.msg, 'Error!',{
                                    closeButton:true
                                });
                            }
                                
                        }
                            
                    }
                });
            }
        }
    });
});