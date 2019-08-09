
<!DOCTYPE html>
<html lang="en">
	
<head>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'header.php';
include 'dbconnection.php';
 
  if (isset($_POST['id'])) {
		$delete = 'DELETE FROM users WHERE id = "'.$_POST['id'].'"';
	   
	   if (mysqli_query($conn, $delete)) {
			return 0;
	   } else {
		  return 1;
	   }
	}




?>
<?php
  if (isset($_POST['id'])) {
	if($_POST['key']!="") {	
		$arr = json_decode($_POST['key']);	
		echo $id = $arr["key"]["id"];exit;
		$name = $arr["key"]["name"];
		$email = $arr["key"]["email"];
		echo $results = "update users set name=".$name.", email=".$email." where id=''";
		exit;
		mysqli_query($conn, $results); 
		echo "success";
		exit;
	}
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
							<a href="url('/')" class="float-right btn btn-secondary btn-lg">
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
						<tr>
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

