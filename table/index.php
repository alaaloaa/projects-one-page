<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "table";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
               // Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$name = $_POST['name'];
	$age  = $_POST['age'];
	$sql  = "INSERT INTO users (name, age) VALUES ('{$name}', '{$age}')";
	if (mysqli_query($conn, $sql)) {
	    echo "user created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}

       /* select users */
$sql =  "SELECT * FROM users";
$query = mysqli_query($conn, $sql);
$users  = [];
while ($user = mysqli_fetch_assoc($query)) {
	$users[] = $user;
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Table</title>
	              <!-- bootsrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <style>
        body {
        	background: #eee
        }
    	.main{
    		margin-top: 100px;
    		background: #fff;
    		padding: 20px
    	}
    	button {
    		outline: none !important; 
    		margin-bottom: 10px !important
    	}
    	th, td {
    		text-align: center;
    	}

    	#alert {
    		width: 50%;
		    position: absolute;
		    left: 25%;
		    top: 5%;
    	}

    	.danger {
    		border-color: red
    	}

    </style>
</head>
<body>
	<div id="alert">
             <!-- alert -->	  
	</div>
	<div class="container main">
		<div class="row">
				<!-- Button for modal -->
			<button title="Add" type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#create-user">
			  Add <i class="fa fa-plus"></i>
			</button><br>
		</div>
		<div class="row">
			<div class="table-responsive">          
			  <table class="table table-striped table-hover table-bordered">
			    <thead>
			      <tr>
			        <th>Name</th>
			        <th>Age</th>
			      </tr>
			    </thead>
			    <tbody id="table-data">
                    <?php foreach ($users as $index => $user ) { ?>	
				        <tr>
	                        <td><?php echo $user['name']; ?></td>
	                        <td><?php echo $user['age']; ?></td>
				        </tr>
                     <?php } ?>
			    </tbody>
			  </table>
			</div>
		</div>
	</div>

	<!-- create user -->
	<div class="modal fade" id="create-user" tabindex="-1" role="dialog"  aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <form id="form" method="POST" action="">
			  <div class="form-group">
			    <label for="name">Name</label>
			    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Your Name" required>
			  </div>
			  <div class="form-group">
			    <label for="age">Age</label>
			    <input type="number" name="age" class="form-control" id="age" placeholder="Enter Your age"required>
			  </div>
	          <button id="add" type="submit" name="submit" class="btn btn-primary pull-right">Add <i class="fa fa-plus"></i></button>
			</form>		 
	      </div>
	    </div>
	  </div>
	</div>
    
	             <!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


<script>

$(document).ready(function() { 	
	        // add new user 
	$(document).on('click','#add',function(e) {
		e.preventDefault()
	  var data = $("#form").serialize();
	  var name = $('#name').val()
	  var age  = $('#age').val()
	  if (name !== '' && age !== '') {
		  $.ajax({
		         data: data,
		         type: "post",
		         url: "index.php",
		         success: function(res){
		         	$('#table-data').append('<tr><td>' + name + '</td><td>' + age + '</td></tr>')
		         	$('#name').val('')
		         	$('#age').val('')
		         	$('#create-user').modal('hide')
	                $('#alert').append('<div class="alert alert-success alert-dismissible text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>user <strong>added </strong>successfully</div>')
	                $('.alert').fadeOut(5000)
	                $('#name').removeClass('danger')
	                $('#age').removeClass('danger')
		         }
		    });
		} else {
			    /* validate */
			if (name == '') {
				$('#name').addClass('danger')				
			} else {
				$('#name').removeClass('danger')
			}
			if (age == '') {
				$('#age').addClass('danger')				
			}  else {
				$('#age').removeClass('danger')
			}
		} 
	 });


})
</script>

<?php mysqli_close($conn);?>
</body>
</html>

