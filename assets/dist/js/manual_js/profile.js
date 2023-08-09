
$("#logofile").change(function(){


    var _URL = window.URL || window.webkitURL;

    var file = $(this)[0].files[0];

    img = new Image();
    var imgwidth = 0;
    var imgheight = 0;
    var maxwidth = 100;
    var maxheight = 100;

    img.src = _URL.createObjectURL(file);
    img.onload = function() 
    {
      imgwidth = this.width;
      imgheight = this.height;
     
      if(imgwidth == maxwidth && imgheight == maxheight){

         
        $("#file_error").html('');
        $('#save').attr("disabled",false);
          var formData = new FormData();
          formData.append('fileToUpload', $('#logofile')[0].files[0]);
 
        }else{
          $("#file_error").html("<p style='color:#dc3545;font-size: 80%;'>Image size must be "+maxwidth+" * "+maxheight+"</p");
          $('#save').attr("disabled",true);
        }
    };
    img.onerror = function() {

        $("#file_error").html("<p style='color:#dc3545;font-size: 80%;'>Not a valid file: " + file.type+"</p>");
        $('#save').attr("disabled",true);
    }
    readUrl(this);
    
});

$('#cancel').click(function() {
    window.location = base_url+'viewprofile';
});

function readUrl(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
            $('#ImdID').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$(document).ready(function () {

    var formId = $('#editProfile');
    formId.validate({
        rules: {
            username: {
                required: true,
                minlength: 5
            },
            email: {
                required: true,
                email: true
            },
            mobile: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 10
            }
        },
        messages: {
            username: {
                required: "Please enter username"
            },
            email: {
                required: "Please enter a email",
                email: "Please enter a valid email"
            },
            mobile: {
                required: "Please enter mobile number"
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
                    url: base_url+'profile/updateprofile',
                    dataType: "json",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success:function(data)
                    {
                        if(formId.valid())
                        {
                            var formData = new FormData(formId[0]);

                            $.ajax({
                                type: "post",
                                url: base_url+'profile/updateprofile',
                                dataType: "json",
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function(response) {
                                    window.location = base_url + 'viewprofile';

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
            }
        }
    });
});

$(document).ready(function () {

    var formId = $('#editPass');
    formId.validate({
        rules: {
            cpass: {
                required: true,
                minlength: 5,
                remote: {
                    type: 'post',
                    url: base_url+'profile/checkOldPassword',
                    data: {
                        'cpass': function () { return $('#cpass').val(); }
                    },
                    dataType: 'json'
                },
            },
            npass: {
                required: true,
                minlength: 5
            },
            rpass: {
                required: true,
                minlength: 5,
                equalTo: '#npass'
            } 
        },
        messages: {
            cpass: {
                required: "Please enter current password",
                remote: "Please enter correct password"
            },
            npass: {
                required: "Please enter new password"

            },
            rpass: {
                required: "Please enter retype password",
                equalTo: "Please enter same password"
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
            if(formId.valid())
            {
                var formData = new FormData(formId[0]);

                $.ajax({
                    type: "post",
                    url: base_url+'profile/updatepassword',
                    dataType: "json",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        window.location = base_url + 'viewprofile';

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

$('#cancel').click(function() {
    window.location = base_url+'viewprofile';
});

