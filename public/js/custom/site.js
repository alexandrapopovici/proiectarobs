$(document).ready(function() {
$(window).load(function() {
    $('.flexslider').flexslider();
  });

    var div=$("#indexdiv");  
    div.animate({left:'300px'},"slow");
    div.animate({fontSize:'2em'},"slow");

    $('#validate-login').validate({
        rules: {
    		username: {required:true}, 
    		password: {required: true}
        },messages: {
			username:{required:"The username field is required"},
			password:{required:"The password field is required"}
                    }
                
});

$('#validate-new_password').validate({
        rules: {
    		new_password: {required:true,minlength:8},
    		password: {required: true}
        },messages: {
			new_password:{required:"The new password field is required",
                        minlenght:"The new password must contain at least 8 character"},
			password:{required:"The password field is required"}
                    }
                
});
    
    $('#validate-user').validate({
        rules:{
            username: {required:true,minlength:5},
            password: {required:true,minlength:8},
            confirm_password: {required:true,equalTo:'#password'},
            email: {required:true,email:true}
            
        },messages:{
            username:{required:"The username field is required",
                   minlength:"The username must contain al least 5 characters"},
            password:{required:"The password field is required",
                         minlength:"The password must contain at least 8 character"},
            confirm_password:{required:"The confirm_password field is required",
                         equalTo:"The confirm_password must be identical with the password"},         
            email:{required:"The email field is required",
                    email:"The email must have a valid format"}           
    }      
});

$("#accordion > li").click(function(){
	if(false == $(this).next().is(':visible')) {
		$('#accordion > ul').slideUp(300);
	}
	$(this).next().slideToggle(300);
});
$('#create-user-details').validate({
    	rules: {
    		username: "required", 
    		password: {
    			required: true,
    			minlength: 8
    		},
 			email: {
 				required: true,
 				email: true
 			}
		},
		messages: {
			username: "The username field is required.",
			password: {
				required: "The password field is required.",
				minlength: "The password must be at least 8 characters."
			},
			email: {
				required: "The email field is required.",
				email: "The email is not valid"
			}
		}
    });
    
   
    $('.deletemessage').click(function() {
        var id = $(this).attr('id');
        var idmessage = id.split("_")[1];
        console.log(idmessage);
        $('#confdeletemessage').click(function() {
            $.ajax({
                dataType: "json",
                url: baseUrl + '/message/delete/' + idmessage,
                type: 'post',
                success: function(result) {
                    if(result.succes) {
                        $('#message_'+idmessage).remove();
                        $('#myModal').modal('hide');
                        $('#message').html("<p>"+result.message+"</p>");
                    } else{
                        $('#myModal').modal('hide');
                        $('#message').html("<p>"+result.message+"</p>");
                    }
                }
            });
        });
    });
    
    $('#canceldelmessage').click(function(){
       $('#myModal').modal('hide');
    });
    
    $('#cancelsendmessage').click(function(){
       $('#myModal').modal('hide');
    });
  
  $('.sendmessages').click(function() {
      
        var id = $(this).attr('id');
        var idreceiver = id.split("_")[1];
        $('.receiver').val(idreceiver);
        
  });
  
 
        
  
});
