$("#validatedCustomFile").change(function(){


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
          formData.append('fileToUpload', $('#validatedCustomFile')[0].files[0]);
 
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

function readUrl(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
            $('#ImdID').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// Add validation
$(document).ready(function() {

    
    var formId = $("#branch_add_form");

    formId.validate({
       
        rules: {
            'first_name': {
                required: true,           
            },
            'mobile_number': {
                required: true,
                number: true,  
                minlength:10,
                maxlength:10,
                remote: {
                    type: 'post',
                    url: base_url+'branch/checknumberAlredyExist',
                    data: {
                        'mobile_number': function () { return $('#mobile_number').val(); }
                    },
                    dataType: 'json'
                },
            },
            'username': {
                required: true,
                 remote: {
                    type: 'post',
                    url: base_url+'branch/checkUserNameAlredyExist',
                    data: {
                        'username': function () { return $('#username').val(); }
                    },
                    dataType: 'json'
                },
            },
            'password': {
                required: true,
            }, 
            'cpassword': {
                required: true,
                equalTo : '#password'
            }, 
            'branch_name': {
                required: true,
            }, 
            'branch_code': {
                required: true,
                remote: {
                    type: 'post',
                    url: base_url+'branch/checkBranchCodeAlredyExist',
                    data: {
                        'branch_code': function () { return $('#branch_code').val(); }
                    },
                    dataType: 'json'
                },
            }, 
            'state_id': {
                required: true,
            },
            'city_id': {
                required: true,
            },
            'branch_address': {
                required: true,
            },
            'pincode': {
                required: true,
            },
           
            'branch_mobile_number': {
                required: true
               // minlength:10,
               // maxlength:10
            },
            'status': {
                required: true,
            },
            'email_id': {
                required: true
            },
            'reg_no': {
                required: true
            },
            'gst_no': {
                required: true
            },
            'pan_no': {
                required: true
            }
        },
        messages: {
            'first_name': {
                required: "Enter first name.",
            },
            'mobile_number': {
                required: "Enter mobile number.",
                remote: jQuery.validator.format("{0} is already taken.")
            },
            'username': {
                required: " Select Status", 
                remote: jQuery.validator.format("{0} is already taken.")
            },
           
            'password': {
                required: "Enter password",
            }, 
            'cpassword': {
                required: 'Enter confirm password',
                equalTo: 'Enter Confirm Password Same as Password',
            }, 
            'branch_name': {
                required: 'Enter branch name',
            }, 
            'branch_code': {
                required: 'Enter branch code',
                remote: jQuery.validator.format("{0} is already taken.")
            }, 
            'state_id': {
                required: 'Select state',
            },
            'city_id': {
                required: 'select city',
            },
            'branch_address': {
                required: 'Enter branch address',
            },
            'pincode': {
                required: 'Enter pincode ',
            },
           
            'status': {
                required: 'Select status',
            },
            'branch_mobile_number': {
                required: 'Enetr mobile number',
            },
            'email_id': {
                required: 'Enetr Email ID'
            },
            'reg_no': {
                required: 'Enetr Registration Number'
            },
            'gst_no': {
                required: 'Enetr GST Number'
            },
            'pan_no': {
                required: 'Enetr PAN Number'
            }
        }, 
        errorClass: 'invalid-feedback animated fadeInDown',
        errorElement: 'div',
        errorPlacement: (error, e) => {
            jQuery(e).parents('.form-group').append(error);
        },
        highlight: e => {
            jQuery(e).closest('.form-group').removeClass('is-invalid').addClass('is-invalid');
        },
        success: e => {
            jQuery(e).closest('.form-group').removeClass('is-invalid');
            jQuery(e).remove();
        },
        focusInvalid: true,
        invalidHandler: function(form, validator) {
            if (!validator.numberOfInvalids())
                return;
            validator.errorList[0].element.focus(); 

        },
        submitHandler: function(form) {
            if (formId.valid() == true) {

                var formData = new FormData(formId[0]);

                $.ajax({
                    type: "POST",
                    url: base_url + 'Branch/add_branch',
                    data: formData,
                    dataType: "JSON",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.rs) {
                           
                            window.location = base_url + 'branch';    

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
            return false;
        }


    });

});

$(document).ready(function() {

    
    var formId = $("#branch_edit_form");

    formId.validate({
       
        rules: {
            'first_name': {
                required: true,
            },
            'mobile_number': {
                required: true,
                number: true,  
                minlength:10,
                maxlength:10,
                 remote: {
                    type: 'post',
                    url: base_url+'branch/checknumberAlredyExist',
                    data: {
                        'mobile_number': function () { return $('#mobile_number').val(); },
                        'branch_id': function () { return $('#branch_id').val(); }
                    },
                    dataType: 'json'
                },
            },
            'username': {
                required: true,
                 remote: {
                    type: 'post',
                    url: base_url+'branch/checkUserNameAlredyExist',
                    data: {
                        'username': function () { return $('#username').val(); },
                        'branch_id': function () { return $('#branch_id').val(); }
                    },
                    dataType: 'json'
                },
            },
            'password': {
                required: true,
            }, 
            'cpassword': {
                required: true,
                equalTo : '#password'
            }, 
            'branch_name': {
                required: true,
            }, 
            'branch_code': {
                required: true,
                remote: {
                    type: 'post',
                    url: base_url+'branch/checkBranchCodeAlredyExist',
                    data: {
                        'branch_code': function () { return $('#branch_code').val(); },
                        'branch_id': function () { return $('#branch_id').val(); }
                    },
                    dataType: 'json'
                },
            }, 
            'state_id': {
                required: true,
            },
            'city_id': {
                required: true,
            },
            'branch_address': {
                required: true,
            },
            'pincode': {
                required: true,
            },
            'branch_mobile_number': {
                required: true
               // minlength:10,
               // maxlength:10
            },
            'status': {
                required: true,
            },
            'email_id': {
                required: true
            },
            'reg_no': {
                required: true
            },
            'gst_no': {
                required: true
            },
            'pan_no': {
                required: true
            }
        },
        messages: {
            'first_name': {
                required: "Enter first name.",
            },
            'mobile_number': {
                required: "Enter mobile number.",
                remote: jQuery.validator.format("{0} is already taken.")
            },
            'username': {
                required: " Select Status", 
                remote: jQuery.validator.format("{0} is already taken.")
            },
            'password': {
                required: "Enter password",
            }, 
            'cpassword': {
                required: 'Enter confirm password',
                equalTo: 'Enter Confirm Password Same as Password',
            }, 
            'branch_name': {
                required: 'Enter branch name',
            }, 
            'branch_code': {
                required: 'Enter branch code',
                remote: jQuery.validator.format("{0} is already taken.")
            }, 
            'state_id': {
                required: 'Select state',
            },
            'city_id': {
                required: 'select city',
            },
            'branch_address': {
                required: 'Enter branch address',
            },
            'pincode': {
                required: 'Enter pincode ',
            },
           
            'status': {
                required: 'Select status',
            },
            'branch_mobile_number': {
                required: 'Enetr mobile number',
            },
            'email_id': {
                required: 'Enetr Email ID'
            },
            'reg_no': {
                required: 'Enetr Registration Number'
            },
            'gst_no': {
                required: 'Enetr GST Number'
            },
            'pan_no': {
                required: 'Enetr PAN Number'
            }
        }, 
        errorClass: 'invalid-feedback animated fadeInDown',
        errorElement: 'div',
        errorPlacement: (error, e) => {
            jQuery(e).parents('.form-group').append(error);
        },
        highlight: e => {
            jQuery(e).closest('.form-group').removeClass('is-invalid').addClass('is-invalid');
        },
        success: e => {
            jQuery(e).closest('.form-group').removeClass('is-invalid');
            jQuery(e).remove();
        },
        focusInvalid: true,
        invalidHandler: function(form, validator) {
            if (!validator.numberOfInvalids())
                return;
            validator.errorList[0].element.focus(); 

        },
        submitHandler: function(form) {
            if (formId.valid() == true) {

                var formData = new FormData(formId[0]);

                $.ajax({
                    type: "POST",
                    url: base_url + 'branch/edit_branch',
                    data: formData,
                    dataType: "JSON",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.rs) {
                           
                            window.location = base_url + 'branch';    

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
            return false;
        }


    });

});


$(document).on("click", ".view_details", function() {
    var branch_id = $(this).data('id');

    $.ajax({
        type: "POST",
        url: base_url + 'branch/getdetails',
        data: { branch_id: branch_id },
        dataType: 'JSON',
        cache: false,
        success: function(data) {
            $('#branch_name').text(data.branch_name);
            $('#first_name').text(data.first_name);
            $('#last_name').text(data.last_name);
            $('#username').text(data.username);
            $('#email_id').text(data.email_id);
            $('#mobile_number').text(data.mobile_number);
            $('#branch_address').text(data.branch_address);
            $('#status').text(data.status);
            $('#created_on').text(data.created_on);
        },
        error: function(xhr, status, error) {
            Codebase.helpers('notify', { align: 'right', from: 'top', type: 'danger', icon: 'fa fa-time mr-5', message: error });
        },

    });
});

 
$(document).on('change', "#state_id", function() {
                 
    var state_id = $(this).val();
    if (state_id) {
        $.ajax({
            type: 'POST',
            url: base_url+'location/getCityByStateId',
            data: { state_id: state_id },
            dataType:'JSON',
            success: function(data) {

                $('#city_id').html('<option value="">Select city Name</option>');
              

                if (data) {
                    $(data).each(function() {
                        var option = $('<option />');
                        option.attr('value', this.city_id).text(this.city_name);

                        $('#city_id').append(option);
                        //$("#city_id").selectpicker('refresh');

                    });
                } else {
                    
                    $('#city_id').html('<option value="">State not available</option>');
                }
            }
        });
    }
});


// get city by state id for edit

$(document).on('change', "#edit_state_id", function() {
                 

    var state_id = $(this).val();
    if (state_id) {
        $.ajax({
            type: 'POST',
            url: base_url+'location/getCityByStateId',
            data: { state_id: state_id },
            dataType:'JSON',
            success: function(data) {

                $('#edit_city_id').html('<option value="">Select city Name</option>');
              

                if (data) {
                    $(data).each(function() {
                        var option = $('<option />');
                        option.attr('value', this.city_id).text(this.city_name);

                        $('#edit_city_id').append(option);
                        $("#edit_city_id").selectpicker('refresh');

                    });
                } else {
                    
                    $('#edit_city_id').html('<option value="">State not available</option>');
                }
            }
        });
    }
});

$('#branchbtn').click(function() {
    window.location = base_url + 'branch';
});
// get zone by city id for add

$(document).on("click", ".change_status", function() {
    var branch_id = $(this).data('id');


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
                url: base_url + 'branch/changestatus',
                data: { branch_id: branch_id },
                dataType: 'json',
                cache: false,
                success: function(data) {

                    window.location = base_url + 'branch';
 
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

$(document).on("click", ".branch_delete", function() {
    var branch_id = $(this).data('id');


    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this branch!",
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
                url: base_url + 'branch/deletebranch',
                data: { branch_id: branch_id },
                dataType: 'json',
                cache: false,
                success: function(data) {

                    window.location = base_url + 'branch';
 
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


$(document).ready(function() {

    var _URL = window.URL || window.webkitURL;
    $("#logo_image").change(function(e) {
        //$("#image_upload-error").remove();

        var file, img;
        if ((file = this.files[0])) {
            img = new Image();
            img.onload = function() {
                $('#logo_image').data('minWidth', this.width);
                $('#logo_image').data('minHeight', this.height);
                var a = $('#logo_image').data('minWidth');

            };
            img.src = _URL.createObjectURL(file);
            if (file != "") {
                $("#logo_image").rules("add", {
                    required: true,
                    minImageWidth: 230,
                    minImageHeight: 70,
                    messages: {
                        required: "Please select Your Logo",

                    }
                });
            }
        }
    });
});


$(document).ready(function() {

    var _URL = window.URL || window.webkitURL;
    $("#edit_logo_image").change(function(e) {
        //$("#image_upload-error").remove();

        var file, img;
        if ((file = this.files[0])) {
            img = new Image();
            img.onload = function() {
                $('#edit_logo_image').data('minWidth', this.width);
                $('#edit_logo_image').data('minHeight', this.height);
                var a = $('#edit_logo_image').data('minWidth');

            };
            img.src = _URL.createObjectURL(file);
            if (file != "") {
                $("#edit_logo_image").rules("add", {
                    required: true,
                   minImageWidth: 230,
                    minImageHeight: 70,
                    messages: {
                        required: "Please select Your Logo",

                    }
                });
            }
        }
    });
});

$.validator.addMethod('minImageWidth', function(value, element, minWidth) {
    return this.optional(element) || ($(element).data('minWidth') || 0) == minWidth;
}, function(minWidth, element) {
    var imageWidth = $(element).data('minWidth');
    return (imageWidth) ? ("Your image's width must be equal " + minWidth + "px") : "Selected file is not an image.";
});

$.validator.addMethod('minImageHeight', function(value, element, minHeight) {
    return this.optional(element) || ($(element).data('minHeight') || 0) == minHeight;
}, function(minHeight, element) {
    var imageHeight = $(element).data('minHeight');
    return (imageHeight) ? ("Your image's height must be equal " + minHeight + "px") : "Selected file is not an image.";
});

function CheckNumeric(e) {
    if (window.event) // IE
    {
        if ((e.keyCode < 48 || e.keyCode > 57) & e.keyCode != 8 && e.keyCode != 44) {
            event.returnValue = false;
            return false;
        }
    }
    else { // Fire Fox
        if ((e.which < 48 || e.which > 57) & e.which != 8 && e.which != 44) {
            e.preventDefault();
            return false;
        }
    }
}   