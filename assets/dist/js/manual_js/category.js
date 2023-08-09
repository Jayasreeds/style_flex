 $(document).ready(function() {
    var formId = $('#addCategoryForm');
    $('#addCategoryForm').validate({
        rules: {
            category: {
                required: true,
                remote: {
                    type: 'post',
                    url: base_url+'category/checkCategoryAlredyExist',
                    data: {
                        category: function () { return $('#category').val(); }
                    },
                    dataType: 'json'
                },
            },
            // sub_category: {
            //     required: true,
            //     remote: {
            //         type: 'post',
            //         url: base_url+'category/checkSubCategoryAlredyExist',
            //         data: {
            //             sub_category: function () { return $('#sub_category').val(); }
            //         },
            //         dataType: 'json'
            //     },
            // }
             status: {
                required: true
            }
        },
        messages: {
            category: {
                required: "Enter Category name",
                remote: jQuery.validator.format("{0} is already taken.")
            },
            // sub_category: {
            //     required: "Enter Subcategory name",
            //     remote: jQuery.validator.format("{0} is already taken.")
            // }
             status: {
                required: "Select the status"
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
                url: base_url + 'category/add_category',
                data: formData,
                dataType: "JSON",
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.rs) {
                       
                        window.location = base_url + 'category';    

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


 $(document).on("click", ".view_details", function() {
    var category_id = $(this).data('id');

    $.ajax({
        type: "POST",
        url: base_url + 'category/getdetails',
        data: { category_id: category_id },
        dataType: 'JSON',
        cache: false,
        success: function(data) {
            $('#category').text(data.category);
            $('#sub_category').text(data.sub_category);

        },
        error: function(xhr, status, error) {
            Codebase.helpers('notify', { align: 'right', from: 'top', type: 'danger', icon: 'fa fa-time mr-5', message: error });
        },

    });
});


$(document).ready(function() {
    var formId = $('#editCategoryForm');
    $('#editCategoryForm').validate({
        rules: {
            category: {
                required: true,
                remote: {
                    type: 'post',
                    url: base_url+'category/checkCategoryAlredyExist',
                    data: {
                        category: function () { return $('#category').val(); }
                    },
                    dataType: 'json'
                },
            },
            // sub_category: {
            //     required: true,
            //     remote: {
            //         type: 'post',
            //         url: base_url+'category/checkSubCategoryAlredyExist',
            //         data: {
            //             sub_category: function () { return $('#sub_category').val(); }
            //         },
            //         dataType: 'json'
            //     },
            // }
             status: {
                required: true
            }
        },
        messages: {
            category: {
                required: "Enter Category name",
                remote: jQuery.validator.format("{0} is already taken.")
            },
            // sub_category: {
            //     required: "Enter Subcategory name",
            //     remote: jQuery.validator.format("{0} is already taken.")
            // }
             status: {
                required: "Select the status"
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
                url: base_url + 'category/updatecategory',
                data: formData,
                dataType: "JSON",
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.rs) {
                       
                        window.location = base_url + 'category';    

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

$(document).on("click", ".category_delete", function() {
    var category_id = $(this).data('id');


    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this Category!",
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
                url: base_url + 'category/deletecategory',
                data: { category_id: category_id },
                dataType: 'json',
                cache: false,
                success: function(data) {

                    window.location = base_url + 'category';
 
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