<!doctype html>
<html>
<?php include 'header.php';
include 'dbconnection.php';?>

<?php

/**registration form**/
if(isset($_POST['signup'])){
	$name = $_POST['username'];
    $email = $_POST['email']; 
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    
     //~ $email = mysql_real_escape_string($_POST['email']);
    $results = "select email from users where email='$email' ";
	$data = mysqli_query($conn, $results); 
    $row = mysqli_num_rows($data);
	if ($row > 0 ) {
	//if $row is greater than 0, (means the email exists)
		echo"<script language='javascript'>
		alert('Error: email already exists.Please login to continue');
		</script>
		";
	} 
	else {
	if ($row == 0 ) {
		// $row is equal to 0, (==), this means it didnt find results (email)
		//echo "Email does not exists, so lets add the email to the database";
		$sqll = "insert into users (name,email,password,created_date,active)
			 VALUES ('$name','$email','$password',now(),'A')";
			 $result1 = mysqli_query($conn, $sqll); 
		 echo"<script language='javascript'>
		alert('Successfully registered you email');
		</script>
		";
		session_start();
		$_SESSION['user'] = $email;		
		header('Location: target.php');
		exit;
	}
	    
  } 	
}
/**login form**/
if(isset($_POST['login'])){
    $email = $_POST['email']; 
    $password = $_POST['password'];    
     //~ $email = mysql_real_escape_string($_POST['email']);
    $results2 = "select email from users where email='$email' and password = '$password'";
	$data2 = mysqli_query($conn, $results2); 
    $row2 = mysqli_num_rows($data2);
	if ($row2 > 0 ) {
	//if $row is greater than 0	
		session_start();
		$_SESSION['user'] = $email;
		header('Location: target.php');
		exit;
	} 
	else {
		echo "<script language='javascript'>
		alert('Error: Please check your login credentials')
		</script>";
	 
  } 	
}

?>

<body>
<!-- form: -->
<section>
	<div class="container">
     <!-- Nav tabs -->
      <div class="text-center mt-5">
        <div class="btn-group">
          <a href="#new" role="tab" data-toggle="tab" class="big btn btn-primary"><i class="fa fa-plus"></i> Create Account</a>
          <a href="#user" role="tab" data-toggle="tab" class="big btn btn-danger"><i class="fa fa-user"></i> Login</a>
        </div>
      </div>
      <p class="text-center mt-3 click2select">Click to select</p>
      <div class=" tab-content w-50 mx-auto">
		   <!--/**tab1**/-->
		   <div class="tab-pane fade in active" id="new">
              <form id="registerForm" method="post" class="form-horizontal" action="">

                         <div class="form-group">
									<input type="text" name="username" class="form-control input-lg" placeholder="Your Name"/>
								
                        </div>
                        <div class="form-group">
                                <input type="text" class="form-control input-lg" name="email" placeholder="e-Mail Address" />
                          
                        </div>

                        <div class="form-group">
                                <input type="password" class="form-control input-lg" name="password" placeholder="Your Password"/>
                           
                        </div>

                        <div class="form-group">
                                <input type="password" class="form-control input-lg" name="confirmPassword" placeholder="Re-type Your Password" />
                           
                        </div>                        
						<div class="form-group tab-content">
							<div class="tab-pane fade in active text-center" id="pp">              
								<button type="submit" class="btn btn-primary btn-lg btn-block" name="signup" value="Sign up">Sign up</button>
							</div>
						</div>
                    </form>
           </div>
			<!--/**tab2**/-->			
		   <div class="tab-pane fade" id="user">
				<form id="loginForm" method="post" class="form-horizontal" action="">
					<div class="form-group">
							<input type="text" class="form-control input-lg"name="email" placeholder="e-Mail Address" />
					</div>
					<div class="form-group">
							<input type="password" class="form-control input-lg" name="password" placeholder="Your Password"/>                           
					</div>
					<div class=" text-center">
						<button type="submit" class="btn btn-primary btn-danger" name="login" value="login">LOGIN</button>
					</div>
				</form>
			</div>
			</div><!--tab-pane-->
      </div><!--tab-content-->
	</div>
</section>
<footer>
<?php include 'footer.php';?>
</footer>
</body>
</html>

