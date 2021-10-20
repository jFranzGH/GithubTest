<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="Assets/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    <title>User Management!</title>
  </head>
  <body>
  	<?php
  		include "db/db.php";
  		if(@$_GET['Edit']){
  			$sql = "SELECT * FROM userdemo WHERE id='".$_GET['Edit']."'";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
			  // output data of each row
			  while($row = $result->fetch_assoc()) {
			    $id = $row["id"];
			    $fname = $row["firstname"];
			    $lname = $row["lastname"];
			    $user = $row["username"];
			    $pass = $row["password"];
			    $email = $row["email"];
			  }
			} else {
			  echo "0 results";
			}
  		}

  	?>
  	<!--NAVIGATION BAR-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <div class="container-fluid">
	    <a class="navbar-brand" href="index.php">User Management</a>
	    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse" id="navbarSupportedContent">
	      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
	        <li class="nav-item">
	          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
	        </li>
	      </ul>
	      <ul class="navbar-nav">
			<li class="nav-item">
	          <a class="nav-link" href="signup.php">Sign Up</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="login.php">Login</a>
	        </li>
	    </ul>
	    </div>
	  </div>
	</nav>
	<!--NAVIGATION BAR END-->
	<br><br>
    <?php
    	//Display all
    	$sqlDisp = "SELECT * FROM userdemo";
		$result = $conn->query($sqlDisp);
		if ($result->num_rows > 0) {
		  // output data of each row
			?>
			<div class="container">
			<form method="POST">
				<div class="row">
				  <div class="col-md-2">
				    <label for="fname" class="form-label">First Name</label>
				    <input type="text" class="form-control" id="fname" name="fname" aria-describedby="emailHelp" value="<?php echo $fname; ?>">
				  </div>
				  <div class="col-md-2">
				    <label for="lname" class="form-label">Lastname</label>
				    <input type="text" class="form-control" id="lname" name="lname" aria-describedby="emailHelp" value="<?php echo $lname; ?>">
				  </div>
				  <div class="col-md-2">
				    <label for="email" class="form-label">Email address</label>
				    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="<?php echo $email; ?>">
				  </div>
				  <div class="col-md-2">
				    <label for="username" class="form-label">Username</label>
				    <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" value="<?php echo $user; ?>">
				  </div>
				  <div class="col-md-2">
				    <label for="password" class="form-label">Password</label>
				    <input type="password" class="form-control" id="password" name="password" value="<?php echo $pass; ?>">
				  </div>
				  <div class="col-md-2">
				  	<label for="update" class="form-label">&nbsp;</label>
				  	<input type="submit" class="btn btn-primary form-control" name="update" value="Update">
				  </div>
			  </div>
			</form>
			<br><br>
			<table class="table table-striped">
			  <thead>
			    <tr>
			      <th scope="col">First Name</th>
			      <th scope="col">Last Name</th>
			      <th scope="col">User Name</th>
			      <th scope="col">Email</th>
			      <th scope="col">Action</th>
			    </tr>
			  </thead>
			  <tbody>
			<?php
		  while($row = $result->fetch_assoc()) {
		    //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
		    ?>
				    <tr>
				      <td><?php echo $row["firstname"]; ?></td>
				      <td><?php echo $row["lastname"]; ?></td>
				      <td><?php echo $row["username"]; ?></td>
				      <td><?php echo $row["email"]; ?></td>
				      <td> <a href="?Edit=<?php echo $row['id']; ?>"><i class="bi bi-pencil"></i></a> | <a href="?Delete=<?php echo $row['id']; ?>"><i class="bi bi-trash"></i></a></td>
				    </tr>
		    <?php
		  }
		} else {
		  echo "0 results";
		}
		?>
			</tbody>
		</table>
		<?php
				//Delete 
		    	if(@$_GET['Delete']){
		  			$sql = "DELETE FROM userdemo WHERE id='".$_GET['Delete']."'";
		  			if ($conn->query($sql) === TRUE) {
					  ?>
					  	<div class="alert alert-success text-center" role="alert">
						  <h4 class="alert-heading">Successfuly Deleted!</h4>
						</div>
					  <?php
					} else {
					  echo "Error deleting record: " . $conn->error;
					}
		  		}
		  		//Update 
		  		if(@$_POST['update']){
		  			$sqlUpdate = "UPDATE userdemo SET firstname='".$_POST['fname']."', lastname='".$_POST['lname']."', username='".$_POST['username']."', password='".$_POST['password']."', email='".$_POST['email']."' WHERE id=".$_GET['Edit']."";
					if ($conn->query($sqlUpdate) === TRUE) {
					    ?>
					  	<div class="alert alert-success text-center" role="alert">
						  <h4 class="alert-heading">Successfuly Udpated! <a href="index.php" class="alert-link">Ok</a></h4>

						</div>
					  <?php
					} else {
					  echo "Error updating record: " . $conn->error;
					}
	  			}
			?>
		</div>
		<?php
		$conn->close();
    ?>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="Assets/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>