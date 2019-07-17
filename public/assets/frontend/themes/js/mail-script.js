    // -------   Mail Send ajax

    $(document).ready(function() {
        var form = $('#myForm'); // contact form
        var submit = $('.submit-btn'); // submit button
        var alert = $('.alert-msg'); // alert div for show alert message

        // form submit event
        form.on('submit', function(e) {
            e.preventDefault(); // prevent default form submit

            $.ajax({
                url: 'mail.php', // form action url
                type: 'POST', // form submit method get/post
                dataType: 'html', // request type html/json/xml
                data: form.serialize(), // serialize form data
                beforeSend: function() {
                    alert.fadeOut();
                    submit.html('Sending....'); // change submit button text
                },
                success: function(data) {
                    alert.html(data).fadeIn(); // fade in response data
                    form.trigger('reset'); // reset form
                    submit.attr("style", "display: block !important");; // reset submit button text
                },
                error: function(e) {
                    console.log(e)
                }
            });
        });
    });

    // if ($("#myForm").length > 0) {
    //     $("#myForm").validate({
          
    //         rules: {
    //           name: {
    //             required: true,
    //             maxlength: 50
    //           },
          
    //            mobile_number: {
    //                 required: true,
    //                 digits:true,
    //                 minlength: 10,
    //                 maxlength:12,
    //             },
    //             email: {
    //                     required: true,
    //                     maxlength: 50,
    //                     email: true,
    //                 },    
    //         },
            
    //         messages: {
                
    //           name: {
    //             required: "Please enter name",
    //             maxlength: "Your last name maxlength should be 50 characters long."
    //           },
    //           mobile_number: {
    //             required: "Please enter contact number",
    //             minlength: "The contact number should be 10 digits",
    //             digits: "Please enter only numbers",
    //             maxlength: "The contact number should be 12 digits",
    //           },
    //           email: {
    //               required: "Please enter valid email",
    //               email: "Please enter valid email",
    //               maxlength: "The email name should less than or equal to 50 characters",
    //             },   
    //         },
            
    //         submitHandler: function(form) {
    //             $.ajaxSetup({
    //                 headers: {
    //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //                 }
    //             });
    //             $('#send_form').html('Sending..');
    //             $.ajax({
    //                 url: 'http://localhost/laravel-example/save-form' ,
    //                 type: "POST",
    //                 data: $('#contact_us').serialize(),
    //                 success: function( response ) {
    //                     $('#send_form').html('Submit');
    //                     $('#res_message').show();
    //                     $('#res_message').html(response.msg);
    //                     $('#msg_div').removeClass('d-none');
             
    //                     document.getElementById("contact_us").reset(); 
    //                     setTimeout(function(){
    //                     $('#res_message').hide();
    //                     $('#msg_div').hide();
    //                     },10000);
    //                 }
    //             });
    //         }
    //     })
    // }