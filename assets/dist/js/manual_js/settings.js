$(document).ready(function() {
    
    $("#logo").change(function(){


        var _URL = window.URL || window.webkitURL;

        var file = $(this)[0].files[0];

        img = new Image();
        var imgwidth = 0;
        var imgheight = 0;
        var maxwidth = 200;
        var maxheight = 200;

        img.src = _URL.createObjectURL(file);
        img.onload = function() 
        {
          imgwidth = this.width;
          imgheight = this.height;
         
          if(imgwidth == maxwidth && imgheight == maxheight){

             
            $("#logo_error").html('');
            $('#save').attr("disabled",false);
              var formData = new FormData();
              formData.append('fileToUpload', $('#logo')[0].files[0]);
     
            }else{
              $("#logo_error").html("<p style='color:#dc3545;font-size: 80%;'>Image size must be "+maxwidth+" * "+maxheight+"</p");
              $('#save').attr("disabled",true);
            }
        };
        img.onerror = function() {

            $("#logo_error").html("<p style='color:#dc3545;font-size: 80%;'>Not a valid file: " + file.type+"</p>");
            $('#save').attr("disabled",true);
        }
        readUrl1(this);
        
    });

    function readUrl1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#img1').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#icon").change(function(){


        var _URL = window.URL || window.webkitURL;

        var file = $(this)[0].files[0];

        img = new Image();
        var imgwidth = 0;
        var imgheight = 0;
        var maxwidth = 200;
        var maxheight = 200;

        img.src = _URL.createObjectURL(file);
        img.onload = function() 
        {
          imgwidth = this.width;
          imgheight = this.height;
         
          if(imgwidth == maxwidth && imgheight == maxheight){

             
            $("#icon_error").html('');
            $('#save').attr("disabled",false);
              var formData = new FormData();
              formData.append('fileToUpload', $('#logo')[0].files[0]);
     
            }else{
              $("#icon_error").html("<p style='color:#dc3545;font-size: 80%;'>Image size must be "+maxwidth+" * "+maxheight+"</p");
              $('#save').attr("disabled",true);
            }
        };
        img.onerror = function() {

            $("#icon_error").html("<p style='color:#dc3545;font-size: 80%;'>Not a valid file: " + file.type+"</p>");
            $('#save').attr("disabled",true);
        }
        readUrl2(this);
        
    });

    function readUrl2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#img2').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    var formId = $('#editSiteDetails');
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
        submitHandler:function() {
            if(formId.valid() == true)
            {
                var formData = new FormData(formId[0]);
                
                
                     $.ajax({
                    type: "post",
                    url: base_url+'Sitesettings/updatesetting',
                    dataType: "json",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                       
                        if (response.rs) {
                           
                            window.location = base_url + 'sitesettings';    

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

 