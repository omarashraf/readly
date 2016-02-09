<html>

<head>
	<link rel="stylesheet" href="assets/css/bootmetro.css">
	<script src="assets/js/bootmetro.js"></script>
</head>



<body>
	<form enctype='multipart/form-data' method="post">
		<input type='hidden' name='registered' id='registered' value='1'></input>
		<input type="text" name="name" id="name" placeholder="Name"></input><br><br>
		<?php
			include('helper_functions.php');
		 	if((!isset($_POST['registered'])) || (isset($_POST['registered']) && checkEmail($_POST['email']))) { 
		?>
		<input type="text" name="email" id="email" placeholder="Email"></input><br><br>
		<?php }
			if(isset($_POST['registered']) && !checkEmail($_POST['email'])) {
		?>
		<div class="control-group error">
	         <div class="controls">
		         <input type="text" id="inputError" name="email">
		         <span class="help-inline">Please correct the error</span>
	         </div>
	   </div>
		<?php } ?>
		<input type="password" name="password" id="password" placeholder="Password"></input><br><br>
		<input type="file" name="image" id="image" class="btn"></input><br><br>
		<button type="submit">Submit</button>
	</form>
	<?php
		session_start();

		

		if(isset($_POST['registered'])) {
			if(!checkEmail($_POST['email'])) {
				echo "Make sure you included '@' and '.' and that they are in the correct order.";
			} else {
				if(!checkPassword($_POST['password'])) {
					echo "Password is at least 8 characters long and should contain at least one number.";
				} else {
					$insert_users_sql = "INSERT INTO users (name, email, password) VALUES ('" . $_POST['name'] . "', '" . $_POST['email'] . "', '" . 
						$_POST['password'] . "'" . ")";
					if(mysql_query($insert_users_sql)) {
						// destination to be changed
						header('Location: test.php');
					} else {
						die('Error: ' . mysql_error());	
					}
				}	
			}
		}
	?>
</body>

</html>