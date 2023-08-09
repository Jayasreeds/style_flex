function checkRowEmpty() {
    result = true;
    $('#typeTable > tbody > tr').each(function(i) {
        var type_name = $(this).find('.type_name').val();

        if (type_name == "") {
            $(this).find('.type_name').focus();
            result = false;
            toastr.error('Please Enter Type name', 'Error!',{
                closeButton:true
            })
            return false;
        }

    }); 

    return result;

}

$(document).on('click', '#checkAll', function() {           
        $(".itemRow").prop("checked", this.checked);
    }); 
    $(document).on('click', '.itemRow', function() {    
        if ($('.itemRow:checked').length == $('.itemRow').length) {
            $('#checkAll').prop('checked', true);
        } else {
            $('#checkAll').prop('checked', false);
        }
    });

    var count = $(".itemRow").length;
    $(document).on('click', '#addRows', function() { 
        count++;
        var htmlRows = '';
        htmlRows += '<tr>';
        htmlRows += '<td><input class="itemRow" type="checkbox"></td>';          
        htmlRows += '<td><input type="text" class="form-control type_name" name="type_name[]" placeholder="Type Name"></td>';                   
        htmlRows += '</tr>';
        $('.purchase_table').append(htmlRows);
    }); 
    $(document).on('click', '#removeRows', function(){
        $(".itemRow:checked").each(function() {
            if ($('#typeTable .purchase_table').find('tr').length > 1) {
                $(this).closest('tr').remove();
            }
            else
            {
                toastr.error('It must have atlease 1 row', 'Error!',{
                closeButton:true
            })
            }
        });
        $('#checkAll').prop('checked', false);
     });

var template = $('#line_1').clone();

$('#cloneButton').click(function() {
    if(checkRowEmpty() == true)
    {
        var rowId = $('.row .addmore').length + 1;
        var klon = template.clone();
        klon.attr('id', 'line_' + rowId)
            .insertAfter($('.row .addmore').last())
            .each(function() {
              $(this).attr('id', $(this).attr('id').replace(/_(\d*)$/, "_" + rowId));
        })
    }
    
});

$(document).on("click", ".remove", function() {
    if($('.addmore').length > 1)
    {
        $(this).closest(".row .addmore").remove();
    }
    else
    {
        toastr.error('It must have atleast 1 row', 'Error!',{
            closeButton:true
        });
    }
    
});

$(document).ready(function () {

    var formId = $('#typeForm');
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
            if(checkRowEmpty() == true)
            {
                var formData = new FormData(formId[0]);

                $.ajax({
                    type: "post",
                    url: base_url+'size/addtypedetails',
                    dataType: "json",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.rs) {
                           
                            window.location = base_url + 'size/addtype';    

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
    var size_id = $(this).data('id');

    $.ajax({
        type: "POST",
        url: base_url + 'size/getdetails',
        data: { size_id: size_id },
        dataType: 'JSON',
        cache: false,
        success: function(data) {
            $('#v_sizetype').text(data.type_name);
            $('#v_sizedet').text(data.size);
            $('#v_note').text(data.note);
            $('#v_status').text(data.status);
            
        },
        error: function(xhr, status, error) {
            Codebase.helpers('notify', { align: 'right', from: 'top', type: 'danger', icon: 'fa fa-time mr-5', message: error });
        },

    });
});

$(document).on("click", ".size_delete", function() {
    var size_id = $(this).data('id');


    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this size!",
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
                url: base_url + 'size/deletesize',
                data: { size_id: size_id },
                dataType: 'json',
                cache: false,
                success: function(data) {

                    window.location = base_url + 'size';
 
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


$(document).ready(function () {

    var formId = $('#addSizeForm');
    formId.validate({
        rules: {
            sizetype: {
                required: true
            },
            lsize: {
                required: true,
                number: true 
            },
            wsize: {
                required: true,
                number: true
            },
            status: {
                required: true
            }
        },
        messages: {
            sizetype: {
                required: "Select size Type"
            },
            lsize: {
                required: "Enter the size" 
            },
            wsize: {
                required: "Enter the size" 
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
                    url: base_url+'size/addsize',
                    dataType: "json",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#newtodo').modal('hide');
                       
                        window.location = base_url + 'size';
                            

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

 
$(document).ready(function () {

    var formId = $('#editSizeForm');
    formId.validate({
        rules: {
            edt_sizetype: {
                required: true
            },
            edt_lsize: {
                required: true,
                number: true 
            },
            edt_wsize: {
                required: true,
                number: true
            },
            edt_status: {
                required: true
            }
        },
        messages: {
            edt_sizetype: {
                required: "Select size Type"
            },
            edt_lsize: {
                required: "Enter the size" 
            },
            edt_wsize: {
                required: "Enter the size" 
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
                    url: base_url+'size/editsize',
                    dataType: "json",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#edittodo').modal('hide');
                        
                        window.location = base_url + 'size';
                      

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

$(document).on("click", ".get_edit_details", function() {
    var size_id = $(this).data('id');

    $.ajax({
        type: "POST",
        url: base_url + 'size/geteditdetails',
        data: { size_id: size_id },
        dataType: 'JSON',
        cache: false,
        success: function(data) {
            $('#edt_sizetype').select2('val',[data.type_id]);
            $('#edt_lsize').val(data.lsize);
            $('#edt_wsize').val(data.wsize);
            $('#edt_note').val(data.note);
            $('#edt_status').select2('val',[data.status]);
            $('#size_id').val(data.size_id);
            
        },
        error: function(xhr, status, error) {
            Codebase.helpers('notify', { align: 'right', from: 'top', type: 'danger', icon: 'fa fa-time mr-5', message: error });
        },

    });
});

$(document).on("click", ".change_status", function() {
    var size_id = $(this).data('id');


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
                url: base_url + 'size/changestatus',
                data: { size_id: size_id },
                dataType: 'json',
                cache: false,
                success: function(data) {

                    window.location = base_url + 'size';
 
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
