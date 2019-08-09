
<!-- jQuery and Bootstrap JS -->
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<!-- BootstrapValidator JS -->
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery.bootstrapvalidator/0.5.0/js/bootstrapValidator.min.js"></script>
<!---vanilla js--->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vquery/5.0.1/v.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
	$(".edit").click(function(){
		$(this).closest("td").siblings().attr("contenteditable","true");
		$(".edit").closest("td").siblings().css({"background-color":"#f5f7fa", "zoom": "1", "color": "black"});
		$(this).closest("td").siblings().css({"background-color":"#afa8a8", "zoom": "1.5", "color": "white"});		
	});
	$(".delete").click(function(){
			var id = $(this).attr("data-id");
	   		$.ajax({
			type: "POST",
			url: "target.php",
			data: {id:id},
			success: function(result){
				location.reload();
			}
		});
	});
	
	$(".save").click(function(){
		$(this).closest("td").siblings().attr("contenteditable","false");
		var editable = $(this).closest("td").siblings();
		var name = $(editable[0]).text();
		var email = $(editable[1]).text();
		var id = $(this).attr("data-id");
		var jsondata = {"id":id,"name":name,"email":email};
		$.ajax({
			type: "POST",
			url: "target.php",
			data: {key:jsondata},
			success: function(result){
				console.log(result);
			}
		});		
	});	
    $('#registerForm').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            username: {
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: 'The username is required and cannot be empty'
                    },
                    stringLength: {
                        min: 6,
                        max: 30,
                        message: 'The username must be more than 6 and less than 30 characters long'
                    }                  
                }
            },
             email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required and cannot be empty'
                    },
                    identical: {
                        field: 'confirmPassword',
                        message: 'The password and its confirm are not the same'
                    },
                    different: {
                        field: 'username',
                        message: 'The password cannot be the same as username'
                    }
                }
            },
            confirmPassword: {
                validators: {
                    notEmpty: {
                        message: 'The confirm password is required and cannot be empty'
                    },
                    identical: {
                        field: 'password',
                        message: 'The password and its confirm are not the same'
                    },
                    different: {
                        field: 'username',
                        message: 'The password cannot be the same as username'
                    }
                }
            }
        }
    });
    $('#loginForm').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
             email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required and cannot be empty'
                    }
                }
            }
        }
    });
    // Validate the form manually
    $('#validateBtn').click(function() {
        $('#registerForm').bootstrapValidator('validate');
        $('#loginForm').bootstrapValidator('validate');
    });


});
</script>
