<!DOCTYPE html>
<html lang="en">
	
<head>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
if(!isset($_SESSION['user']) &&  ($_SESSION['user']=="")) {
	header('Location: index.php');
	exit;
}
include 'header.php';
include 'dbconnection.php';

/* Delete the user from table */ 
if ((isset($_POST['id'])) && ($_POST['id']!="")) {
	$delete = 'DELETE FROM users WHERE id = "'.$_POST['id'].'"';   
   if (mysqli_query($conn, $delete)) {
	  echo "success";
   } else {
	  echo "failure";
   }
   exit;
}

/* Save the edited user on table */ 
if((isset($_POST['key'])) && ($_POST['key']!="")) {		
	$arr = $_POST['key'];	
	$id = $arr["id"];
	$name = $arr["name"];
	$email = $arr["email"];
	$results = "update users set name='".$name."', email='".$email."' where id=".$id;
	mysqli_query($conn, $results); 
	if (mysqli_query($conn, $results)) {
		echo "success";
	}
	else {
	  echo "failure";
   }
   exit;
}

?>
</head>
<body>
    <div class="container">
        <div class="w-100">
            <div class="table-title">
                <div class="row">
                    <div class="mt-5 d-flex justify-content-between col-sm-12">
						<h2>User <b>Details</b></h2>
							<a href="./logout.php" class="float-right btn btn-secondary btn-lg">
							  <span class="glyphicon glyphicon-log-out"></span> Logout
							</a>
						</div>              
                </div>
            </div>            
         <table id="records_view" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>                        
                        <th>Action</th>                        
                    </tr>
                </thead>
               <tbody>
                 <?php 
					$sqldata = "select id, name, email from users where active = 'A'";
					$data1 = mysqli_query($conn, $sqldata); 
					  $row1 = mysqli_num_rows($data1);
					if($row1 > 0)
					{
					while ($row1 = mysqli_fetch_assoc($data1)) {
					?>
						<tr id="row_<?php echo $row1['id']; ?>">
							<td contenteditable="false" class="editable"><?php echo $row1['name']; ?></td>
							<td contenteditable="false" class="editable"><?php echo $row1['email']; ?></td>							
							<td>
								 <a class="edit"  href="javascript:void(0);" data-id=<?php echo $row1['id']; ?> title="Edit" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
								 <a class="save" href="javascript:void(0);" data-id=<?php echo $row1['id']; ?> title="save" data-toggle="tooltip"><i class="fa fa-save"></i></a>
								 <a class="delete" href="javascript:void(0);" data-id=<?php echo $row1['id']; ?> title="Delete"  data-toggle="tooltip"><i class="fa fa-trash-o"></i></a>
							</td>
						</tr>
					<?php
					}
				
				}
				else
				{ ?>
					<tr><td colspan="3" style="text-align:center;">No Records Found</td></tr>
				<?php }
                 ?>
                </tbody>
            </table>
        </div>
    </div>     
                          
<footer>
<?php include 'footer.php';?>
</footer>

</body>
</html>  

