// $(document).on('change', "#state_id", function() {                 
//     var state_id = $(this).val();
//     if (state_id) {
//         $.ajax({
//             type: 'POST',
//             url: base_url+'location/getCityByStateId',
//             data: { state_id: state_id },
//             dataType:'JSON',
//             success: function(data) {

//                 $('#city_id').html('<option value="">Select City</option>');
              

//                 if (data) {
//                     $(data).each(function() {
//                         var option = $('<option />');
//                         option.attr('value', this.city_id).text(this.city_name);

//                         $('#city_id').append(option);

//                     });
//                 } else {
                    
//                     $('#city_id').html('<option value="">State not available</option>');
//                 }
//             }
//         });
//     }
// }); 

$(document).on("click", ".change_paidstatus", function() {
    var bill_no = $(this).data('id');


    swal({
        title: "Are you sure?",
        text: "You want to change this paid status?",
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
                url: base_url + 'billing/change_paidstatus',
                data: { bill_no: bill_no },
                dataType: 'json',
                cache: false,
                success: function(data) {

                    window.location = base_url + 'billing';
 
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

$(document).on("click", ".change_invoicestatus", function() {
    var bill_no = $(this).data('id');


    swal({
        title: "Are you sure?",
        text: "You want to change this invoice status?",
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
                url: base_url + 'billing/change_invoicestatus',
                data: { bill_no: bill_no },
                dataType: 'json',
                cache: false,
                success: function(data) {

                    window.location = base_url + 'billing';
 
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

$(document).on("click", ".invoice_delete", function() {
    var bill_no = $(this).data('id');


    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this invoice!",
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
                url: base_url + 'billing/invoice_delete',
                data: { bill_no: bill_no },
                dataType: 'json',
                cache: false,
                success: function(data) {

                    window.location = base_url + 'billing';
 
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


$(document).on('change', "#customers", function() {
                 
    var customer_id = $(this).val();
    if (customer_id == "new") {

        $('#cus_id').attr('readonly',false);
        $('#cus_name').attr('readonly',false);
        $('#email').attr('readonly',false);
        //$('#status')[0].selectize.enable();
        
        $('#cus_id').val('');
        $('#cus_name').val('');
        $('#email').val('');
        $('#address').val('');
        $('#state_id').select2('val',['']);
        $('#city_id').select2('val',['']);
        //$('#state_id').data('selectize').setValue('');
        //$('#city_id').data('selectize').setValue('');
        $('#zip_code').val('');
        $('#mobile').val('');
        $('#status').val('');
        //$('#status').data('selectize').setValue('');
    }
    else
    {
        $.ajax({
            type: 'POST',
            url: base_url+'customers/getCustomerRow',
            data: { customer_id: customer_id },
            dataType:'JSON',
            success: function(data) {
                if(data)
                {
                    $('#cus_id').val(data.cus_id.toUpperCase());
                    $('#cus_name').val(data.cus_name.toUpperCase());
                    $('#email').val(data.email);
                    $('#address').val(data.address);
                    //$('#state_id').select2('val',data.state_id);
                   // $('#state_id').select2('data', {id: 100, a_key: 'Lorem Ipsum'});
                    //$('#state_id').select2('val',data.state_id);
                    $("#state_id").select2('val', [data.state_id]);

                    //$('#state_id').data('selectize').setValue(data.state_id);
                    $('#city_id').select2('val',[data.city_id]);
                    //$('#city_id').data('selectize').setValue(data.city_id);
                    $('#zip_code').val(data.zip_code);
                    $('#mobile').val(data.mobile);
                    //$('#status').select2('val',data.status);
                    //$('#status').data('selectize').setValue(data.status);

                    $('#cus_id').attr('readonly',true);
                    $('#cus_name').attr('readonly',true);
                    $('#email').attr('readonly',true);
                    //$('#status')[0].selectize.disable();

                }
            }
        });
    }
});


$(document).on('keyup', '.quantity1', function() {

    var new_sum = parseInt($(this).val());
    new_sum *= parseInt($(this).closest('tr').find('.price1').val());
    $(this).closest('tr').find('.total1').val(new_sum);
    calculateSubtotal();
    calculateDiscount();
    calculateGST();

});

$(document).on('change', "#branch_id", function() {
                 
    var branch_id = $(this).val();
    if (branch_id) {
        $.ajax({
            type: 'POST',
            url: base_url+'customers/getCustomers',
            data: { branch_id: branch_id },
            dataType:'JSON',
            success: function(data) {
                $('#customers').html('<option value="">Select Customer</option><option value="new">NEW CUSTOMER</option>');
                
                if (data) {
                    $(data).each(function() {
                        var option = $('<option />');
                        option.attr('value', this.id).text(this.cus_name.toUpperCase());

                        $('#customers').append(option);

                    });
                } else {
                
                    $('#customers').html('<option value="">Customer not available</option>');
                }
            }
        });
    }
});

$(document).on('click', '#removeRows', function(){
     

    $(this).closest('tr').remove();   
    calculateSubtotal();
    calculateDiscount();
    calculateGST();
}); 


$(document).on('change', "#model_id",function () {

    var $this = $(this);
    $('#addMore').attr("style","display:block");
    var model_id = this.value;

    $.ajax({
       
        data: {'model_id':model_id},
        type: 'post',
        dataType: 'json',
        success:function(data)
        {
          //alert($(this).next('select').attr('class'));
          
          // $('.productname').next('select').append(data);
        }
  });
     
});


 
function calculateSubtotal()
{
    var sum1 = 0; 
    $(".total1").each(function() {
        //add only if the value is number
        if (this.value.indexOf(',') > -1) { 
          sum1  += parseFloat(this.value.split(",").join(""));
        }else if(!isNaN(this.value) && this.value.length != 0) {
            sum1 += parseFloat(this.value);
            
        }
    });
    $("#subtotal").val(sum1.toFixed(2)).css("background-color", "#FEFFB0");
    $("#gtotal").val(sum1.toFixed(2)).css("background-color", "#FEFFB0");

}

function calculateDiscount()
{
    var discount = $('#discount').val();
    var subtotal = $('#subtotal').val();
    var dec = (discount / 100).toFixed(2); //its convert 10 into 0.10
    var mult = subtotal * dec; // gives the value for subtract from main value
    var discont = subtotal - mult;
    if (discount != '') {
        $('#gtotal').val(discont.toFixed(2));
    }
    else
    {
        $('#gtotal').val(subtotal.toFixed(2));
    }
}

function calculateGST()
{
    var gst_type = $('#gst').val();
    var gst_val = $('#gstamt').val();
    var subtotal = $('#subtotal').val();
    var discount = $('#discount').val();
    var dec = (discount / 100).toFixed(2); //its convert 10 into 0.10
    var mult = subtotal * dec; // gives the value for subtract from main value
    var discont = subtotal - mult;
    var sum2 = 0;
    if(gst_type == '1')
    {
        var gst = (gst_val/100).toFixed(2);
        sum2 = parseFloat(discont*gst);
        var postgst1 = parseFloat(discont+sum2);

        $('#totalgst').val(sum2.toFixed(2));
        $('#gstprepost').val(postgst1.toFixed(2));
        $('#gtotal').val(postgst1.toFixed(2));
        
    }
    if(gst_type == '2')
    {

        var val3 = parseFloat(100 + Number(gst_val)); 
        var val1 = parseFloat(100 / val3);
        var postgst1 = parseFloat(discont * val1);
        var sum2 = discont-postgst1;
        var postgst2 = sum2+postgst1;

        $('#totalgst').val(sum2.toFixed(2));
        $('#gstprepost').val(postgst1.toFixed(2));
        $('#gtotal').val(postgst2.toFixed(2));
        
    }

    
}   

 
$(document).on('keyup','#discount',function() {
    calculateDiscount();
    calculateGST();
});

$(document).on('keyup','#gstamt',function() {
    calculateGST();
});


 
$(document).ready(function() {

    var formId = $('#addBillForm');
    formId.validate({
        rules: {
            // branch_id: {
            //     required: true
            // },
            // customers: {
            //     required: true
            // },
            // cus_id: {
            //     required: true,
            //     remote: {
            //         type: 'post',
            //         url: base_url+'customers/checkIdAlredyExist',
            //         data: {
                        
            //             'cus_id': function () { return $('#cus_id').val(); },
            //             'id': function () { return $('#customers').val(); }
            //         },
            //         dataType: 'json'
            //     },
            // },
            // cus_name: {
            //     required: true,
            //      remote: {
            //         type: 'post',
            //         url: base_url+'customers/checknameAlredyExist',
            //         data: {
                        
            //             'cus_name': function () { return $('#cus_name').val(); },
            //             'id': function () { return $('#customers').val(); }
            //         },
            //         dataType: 'json'
            //     },
            // },
            // email: {
            //     required: true,
            //     email: true
            // },
            // address: {
            //     required: true
            // },
            // city_id: {
            //     required: true
            // },
            // state_id: {
            //     required: true
            // },
            // zip_code: {
            //     required: true
            // },
            // mobile: {
            //     required: true,
            //     number: true
            // }
            // // status: {
            // //     required: true
            // // },
            // // size: {
            // //     required: true
            // // },
            // // quantity: {
            // //     required: true 
            // // }
        },
        messages: {
            // branch_id: {
            //     required: "Select Branch"
            // },
            // customers: {
            //     required: "Select Customer"
            // },
            // cus_id: {
            //     required: "Enter Customer ID",
            //     remote:  jQuery.validator.format("{0} is already taken.")
            // },
            // cus_name: {
            //     required: "Enter Customer name",
            //     remote:  jQuery.validator.format("{0} is already taken.")
            // },
            // email: {
            //     required: "Enter Customer email",
            //     email: "Enter valid Customer email"
            // },
            // address: {
            //     required: "Enter Customer address"
            // },
            // city_id: {
            //     required: "Select Customer city"
            // },
            // state_id: {
            //     required: "Select Customer state"
            // },
            // zip_code: {
            //     required: "Enter Customer pincode"
            // },
            // mobile: {
            //     required: "Enter Mobile number"
            // }
            // // status: {
            // //     required: "Select Status"
            // // },
            // // size: {
            // //     required: "Select Size"
            // // },
            // // quantity: {
            // //     required: "Enter Quantity" 
            // // }
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
            if (formId.valid() == true) {

                var formData = new FormData(formId[0]);

                $.ajax({
                    type: "POST",
                    url: base_url + 'stock/addstockdetails',
                    data: formData,
                    dataType: "JSON",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if(response.msg == 'temp_save')
                        {  
                            alert(response.data);
                            if(response.error)
                            {
                                toastr.error(response.error, 'Error!',{
                                    closeButton:true
                                });
                            }  
                            else
                            {
                                $('#addtempdata').append(response.data);
                                $('#model_id').select2('val',['']);
                                $('#model_number').val('');
                                
                                
                               // calculateSum1();
                            }                         
                                
                        }
                        else
                        {
                            if (response.rs) {
                               
                                window.location = base_url + 'addbilling';    

                            } else {
                                (response.errType == 'v') ? formId.prepend(showAlert('Required', response.msg)): Codebase.helpers('notify', { align: 'right', from: 'top', type: 'danger', icon: 'fa fa-times mr-5', message: response.msg });
                            }
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


 $(document).on('change', "#category", function() {
                 
    var category_id = $(this).val();
    if (category_id) {
        $.ajax({
            type: 'POST',
            url: base_url+'category/getSubcategory',
            data: { category_id: category_id },
            dataType:'JSON',
            success: function(data) {

                $('#sub_category').html('<option value="">Select Subcategory</option>');
              

                if (data) {
                    $(data).each(function() {
                        var option = $('<option />');
                        option.attr('value', this.category_id).text(this.sub_category);

                        $('#sub_category').append(option);

                    });
                } else {
                    
                    $('#sub_category').html('<option value="">State not available</option>');
                }
            }
        });
    }
});

$(document).on('change','#stock_type',function() {
    var value = $(this).val();
    if(value=='3')
    {
        $('#showid').css('display','none');
    }
    else
    {
        $('#showid').css('display','block');
    }
});

 
$(document).ready(function() {

    var formId = $('#editBillForm');
    formId.validate({
        rules: {
            
        },
        messages: {
            
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
            if (formId.valid() == true) {

                var formData = new FormData(formId[0]);

                $.ajax({
                    type: "POST",
                    url: base_url + 'billing/editbillingdetails',
                    data: formData,
                    dataType: "JSON",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if(response.msg == 'temp_save')
                        {  
                            if(response.error)
                            {
                                toastr.error(response.error, 'Error!',{
                                    closeButton:true
                                });
                            }  
                            else
                            {
                                $('#addtempdata').append(response.data);
                                $('#quality_id').select2('val',['']);
                                $('#size').select2('val',['']);
                                
                                $('#price').val('');
                                $('#quantity').val('');
                                $('#total').val('');
                                calculateSubtotal();
                                calculateDiscount();
                                calculateGST();
                                //calculateSum1();
                            }                         
                                
                        }
                        else
                        {
                            if (response.rs) {
                               
                                window.location = base_url + 'billing';    

                            } else {
                                (response.errType == 'v') ? formId.prepend(showAlert('Required', response.msg)): Codebase.helpers('notify', { align: 'right', from: 'top', type: 'danger', icon: 'fa fa-times mr-5', message: response.msg });
                            }
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

    var formId = $('#sendmailForm1');
    formId.validate({
        rules: {
            cus_mail: {
                required: true,
                email: true
            }
        },
        messages: {
            cus_mail: {
                required: 'Please enter email',
                email: 'Please enter a valid email'
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
            if (formId.valid() == true) {

                var formData = new FormData(formId[0]);

                $.ajax({
                    type: "POST",
                    url: base_url + 'billing/sendmailForm',
                    data: formData,
                    dataType: "JSON",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#newtodo').modal('hide');
                        if (response.rs) {
                               
                            window.location = base_url + 'billing';    

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

    var formId = $('#paidForm');
    formId.validate({
        rules: {
            
        },
        messages: {
            
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
            if (formId.valid() == true) {

                var formData = new FormData(formId[0]);

                $.ajax({
                    type: "POST",
                    url: base_url + 'billing/editpaiddetails',
                    data: formData,
                    dataType: "JSON",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#newtodo').modal('hide');
                        if(response.error)
                        {
                            toastr.error(response.error, 'Error!',{
                                closeButton:true
                            });

                        }
                        else
                        {
                            if (response.rs) {
                               
                                window.location = base_url + 'billing';    

                            } else {
                                (response.errType == 'v') ? formId.prepend(showAlert('Required', response.msg)): Codebase.helpers('notify', { align: 'right', from: 'top', type: 'danger', icon: 'fa fa-times mr-5', message: response.msg });
                            }
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

$(document).on("click", ".get_edit_details", function() {
    var bill_no = $(this).data('id');

    $.ajax({
        type: "POST",
        url: base_url + 'billing/geteditdetails',
        data: { bill_no: bill_no },
        dataType: 'JSON',
        cache: false,
        success: function(data) {
            $('#grand_total1').val(data.grand_total1);
            $('#paid_amount1').val(data.paid_amount1);
            $('#balance1').val(data.balance1);
            $('#billid1').val(data.billid1);
            $('#id1').val(data.id1);
            $('#paid_amount2').val(data.paid_amount1);
            
        },
        error: function(xhr, status, error) {
            Codebase.helpers('notify', { align: 'right', from: 'top', type: 'danger', icon: 'fa fa-time mr-5', message: error });
        },

    });
});

$(document).on('keyup', "#pay_now1",function () {
    var pay_now = this.value;
    var bal = 0;
    var paid = 0;
    paid_amount1 = $('#paid_amount2').val();
    var amt = Number(pay_now) + Number(paid_amount1);
    balance = $('#balance1').val();
    grand_total1 = $('#grand_total1').val();
    
    bal = Number(grand_total1) - parseFloat(amt);
    paid = Number(paid_amount1) + parseFloat(pay_now);

    if(bal<0)
        bal = 0;
   // alert(final);
    $('#balance1').val(bal.toFixed(2));
    $('#paid_amount1').val(paid.toFixed(2));

}); 