
$(document).ready(function () {

    var formId = $('#addCustomerForm');
    formId.validate({
        rules: {
            branch_id: {
                required: true
            },
            cus_id: {
                required: true,
                remote: {
                    type: 'post',
                    url: base_url+'customers/checkIdAlredyExist',
                    data: {
                        
                        'cus_id': function () { return $('#cus_id').val(); }
                    },
                    dataType: 'json'
                },
            },
            cus_name: {
                required: true,
                minlength: 5,
                 remote: {
                    type: 'post',
                    url: base_url+'customers/checknameAlredyExist',
                    data: {
                        
                        'cus_name': function () { return $('#cus_name').val(); }
                    },
                    dataType: 'json'
                },
            },
            // email: {
            //     required: true,
            //     email: true
            // },
            address: {
                required: true
            },
           
            city_id: {
                required: true
            },
            state_id: {
                required: true
            },
            zip: {
                required: true
            },
            mobile: {
                required: true,
                remote: {
                    type: 'post',
                    url: base_url+'customers/checkmobileAlredyExist',
                    data: {
                        
                        'mobile': function () { return $('#mobile').val(); }
                    },
                    dataType: 'json'
                },
            },
            status: {
                required: true
            }

        },
        messages: {
            cus_id: {
                required: "Enter Customer ID",
                remote:  jQuery.validator.format("{0} is already taken.")
            },
            cus_name: {
                required: "Enter Customer Name",
                minlength: "Customer Name must be atleast 5",
                remote:  jQuery.validator.format("{0} is already taken.")
            },
            // email: {
            //     required: "Enter Customer Email",
            //     email: "Enter valid Email"
            // },
            address: {
                required: "Enter Customer Address"
            },
           
            city_id: {
                required: "Enter Customer City"
            },
            state_id: {
                required: "Enter Customer State"
            },
            zip: {
                required: "Enter Customer Zip code"
            },
            mobile: {
                required: "Enter Customer Mobile Number",
                remote:  jQuery.validator.format("{0} is already taken.")
            },
            status: {
                required: "Select the customer"
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
        submitHandler: function(form) {
            if (formId.valid() == true) {

                var formData = new FormData(formId[0]);

                $.ajax({
                    type: "POST",
                    url: base_url + 'customers/add_customer',
                    data: formData,
                    dataType: "JSON",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.rs) {
                           
                            window.location = base_url + 'customers';    

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

$(document).ready(function () {

    var formId = $('#editCustomerForm');
    formId.validate({
        rules: {
            branch_id: {
                required: true
            },
            cus_id: {
                required: true,
                remote: {
                    type: 'post',
                    url: base_url+'Customers/checkIdAlredyExist',
                    data: {
                        'cus_id': function () { return $('#cus_id').val(); },
                        'id': function () { return $('#id').val(); }
                    },
                    dataType: 'json'
                },
            },
            cus_name: {
                required: true,
                minlength: 5,
                 remote: {
                    type: 'post',
                    url: base_url+'customers/checknameAlredyExist',
                    data: {
                        
                        'cus_name': function () { return $('#cus_name').val(); },
                        'id': function () { return $('#id').val(); }
                    },
                    dataType: 'json'
                },
            },
            // email: {
            //     required: true,
            //     email: true
            // },
            address: {
                required: true
            },
           
            city_id: {
                required: true
            },
            state_id: {
                required: true
            },
            zip: {
                required: true
            },
            mobile: {
                required: true,
                number: true,  
                minlength:10,
                maxlength:10,
                 remote: {
                    type: 'post',
                    url: base_url+'customers/checkmobileAlredyExist',
                    data: {
                        
                        'mobile': function () { return $('#mobile').val(); },
                        'id': function () { return $('#id').val(); }
                    },
                    dataType: 'json'
                },
            },
            status: {
                required: true
            }

        },
        messages: {
            branch_id: {
                required: "Please select branch name"
            },
            cus_id: {
                required: "Enter Customer ID",
                remote:  jQuery.validator.format("{0} is already taken.")
            },
            cus_name: {
                required: "Enter Customer Name",
                minlength: "Customer Name must be atleast 5",
                remote:  jQuery.validator.format("{0} is already taken.")
            },
            // email: {
            //     required: "Enter Customer Email",
            //     email: "Enter valid Email"
            // },
            address: {
                required: "Enter Customer Address"
            },           
            city: {
                required: "Enter Customer City"
            },
            state: {
                required: "Enter Customer State"
            },
            zip: {
                required: "Enter Customer Zip code"
            },
            mobile: {
                required: "Enter Customer Mobile Number",
                remote:  jQuery.validator.format("{0} is already taken.")

            },
            status: {
                required: "Select the customer"
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
        submitHandler: function(form) {
            if (formId.valid() == true) {

                var formData = new FormData(formId[0]);

                $.ajax({
                    type: "POST",
                    url: base_url + 'customers/updatecustomer',
                    data: formData,
                    dataType: "JSON",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.rs) {
                           
                            window.location = base_url + 'Customers';    

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
$(document).on("click", ".cus_delete", function() {
    var customer_id = $(this).data('id');


    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this customer!",
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
                url: base_url + 'Customers/deletecustomer',
                data: { customer_id: customer_id },
                dataType: 'json',
                cache: false,
                success: function(data) {

                    window.location = base_url + 'customers';
 
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
                       // $("#city_id").selectpicker('refresh');

                    });
                } else {
                    
                    $('#city_id').html('<option value="">State not available</option>');
                }
            }
        });
    }
});

$(document).on("click", ".change_status", function() {
    var customer_id = $(this).data('id');


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
                url: base_url + 'customers/changestatus',
                data: { customer_id: customer_id },
                dataType: 'json',
                cache: false,
                success: function(data) {

                    window.location = base_url + 'customers';
 
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

$(document).on("click", ".view_details", function() {
    var id = $(this).data('id');

    $.ajax({
        type: "POST",
        url: base_url + 'customers/getdetails',
        data: { id: id },
        dataType: 'JSON',
        cache: false,
        success: function(data) {
            $('#cus_id').text(data.cus_id);
            $('#cus_name').text(data.cus_name);
            $('#email').text(data.email);
            $('#address').text(data.address);
            $('#branch_id').text(data.branch_id);
            $('#state_id').text(data.state_id);
            $('#city_id').text(data.city_id);
            $('#zip_code').text(data.zip_code);
            $('#mobile').text(data.mobile);
            $('#status').text(data.status);
            $('#last_updated').text(data.last_updated);
            
        },
        error: function(xhr, status, error) {
            Codebase.helpers('notify', { align: 'right', from: 'top', type: 'danger', icon: 'fa fa-time mr-5', message: error });
        },

    });
});

$('#cancel').click(function() {
    window.location = base_url+'customers';
});