// function checkRowEmpty() {
//     result = true;
//     $('.addmore').each(function (i) {
//         var price = $(this).find('.price').val();
//         var quality = $(this).find('.quality').val();
//         var size = $(this).find('.size').val();

//         if (price == "") {
//             $(this).find('.price').focus();
//             result = false;
//             toastr.error('Please Enter Price', 'Error!',{
//                 closeButton:true
//             })
//             return false;
//         }
//         else if (quality == "") {
//             $(this).find('.quality').focus();
//             result = false;
//             toastr.error('Please Select quality', 'Error!',{
//                 closeButton:true
//             })
//             return false;
//         }
//         else if (size == "") {
//             $(this).find('.size').focus();
//             result = false;
//             toastr.error('Please Select size', 'Error!',{
//                 closeButton:true
//             })
//             return false;
//         }

//     }); 

//     return result;

// }
$(document).ready(function () {

    var formId = $('#addPriceForm');
    formId.validate({
        rules: {
            quality_id: {
                required: true
            },
            size_id: {
                required: true
            },
            price_val: {
                required: true,
                number: true
            },
            status: {
                required: true
            } 
        },
        messages: {
            quality_id: {
                required: "Select Quality name"
            },
            size_id: {
                required: "Select Size details"
            },
            price_val: {
                required: "Select Quality name",
                number: "Enter valid value"
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

            if(formId.valid())
            {
                var formData = new FormData(formId[0]);

                $.ajax({
                    type: "post",
                    url: base_url+'price/addprice',
                    dataType: "json",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#newtodo').modal('hide');
                        window.location = base_url + 'price';

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
    var price_id = $(this).data('id');

    $.ajax({
        type: "POST",
        url: base_url + 'price/getdetails',
        data: { price_id: price_id },
        dataType: 'JSON',
        cache: false,
        success: function(data) {
            $('#v_quality_id').text(data.v_quality_id);
            $('#v_size_id').text(data.v_size_id);
            $('#v_price_val').text(data.v_price_val);
            $('#v_note').text(data.v_note);
            $('#v_status').text(data.v_status);
            $('#v_last_updated').text(data.v_last_updated);
            
        },
        error: function(xhr, status, error) {
            Codebase.helpers('notify', { align: 'right', from: 'top', type: 'danger', icon: 'fa fa-time mr-5', message: error });
        },

    });
});

$(document).ready(function () {

    var formId = $('#editPriceForm');
    formId.validate({
        rules: {
            edt_quality_id: {
                required: true
            },
            edt_size_id: {
                required: true
            },
            edt_price_val: {
                required: true,
                number: true
            },
            edt_status: {
                required: true
            }   
        },
        messages: {
            quality_id: {
                required: "Select Quality name"
            },
            size_id: {
                required: "Select Size details"
            },
            price_val: {
                required: "Select Quality name",
                number: "Enter valid value"
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

            if(formId.valid())
            {
                var formData = new FormData(formId[0]);

                $.ajax({
                    type: "post",
                    url: base_url+'price/editprice',
                    dataType: "json",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#edittodo').modal('hide');
                        window.location = base_url + 'price';

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

$(document).on("click", ".price_delete", function() {
    var price_id = $(this).data('id');


    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this price detail!",
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
                url: base_url + 'price/deleteprice',
                data: { price_id: price_id },
                dataType: 'json',
                cache: false,
                success: function(data) {

                    window.location = base_url + 'price';
 
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


$(document).on("click", ".get_edit_details", function() {
    var price_id = $(this).data('id');

    $.ajax({
        type: "POST",
        url: base_url + 'price/geteditdetails',
        data: { price_id: price_id },
        dataType: 'JSON',
        cache: false,
        success: function(data) {
            $('#edt_quality_id').select2('val',[data.edt_quality_id]);
            $('#edt_size_id').select2('val',[data.edt_size_id]);
            $('#edt_price_val').val(data.edt_price_val);
            $('#edt_note').val(data.edt_note);
            $('#edt_status').select2('val',[data.edt_status]);
            $('#price_id').val(data.price_id);
            
        },
        error: function(xhr, status, error) {
            Codebase.helpers('notify', { align: 'right', from: 'top', type: 'danger', icon: 'fa fa-time mr-5', message: error });
        },

    });
});


// var template = $('#line_1').clone();

// $('#cloneButton').click(function() {
//     if(checkRowEmpty() == true)
//     {
//         var rowId = $('.row .addmore').length + 1;
//         var klon = template.clone();
//         klon.attr('id', 'line_' + rowId)
//             .insertAfter($('.row .addmore').last())
//             .find('option')
//             .each(function() {
//               $(this).attr('id', $(this).attr('id').replace(/_(\d*)$/, "_" + rowId));
//         })
//     }
    
// });

// $(document).on("click", ".remove", function() {
//     if($('.addmore').length > 1)
//     {
//         $(this).closest(".row .addmore").remove();
//     }
//     else
//     {
//         toastr.error('It must have atleast 1 row', 'Error!',{
//             closeButton:true
//         });
//     }
    
// });

$(document).on("click", ".change_status", function() {
    var price_id = $(this).data('id');


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
                url: base_url + 'price/changestatus',
                data: { price_id: price_id },
                dataType: 'json',
                cache: false,
                success: function(data) {

                    window.location = base_url + 'price';
 
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
