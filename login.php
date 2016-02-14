<html>

<head>
	<link rel="stylesheet" href="assets/css/bootmetro.css">
	<script src="assets/js/bootmetro.js"></script>
</head>



<body>
	<?php
		include('helper_functions.php');
		session_start();
	?>
	<form class="form-horizontal" method="post">
	<input type="hidden" name="login" value="1"></input>
      <div class="control-group">
         <label class="control-label" for="inputEmail">Email</label>
         <div class="controls">
            <input type="text" name="email" id="inputEmail" placeholder="Email">
         </div>
      </div>
      <div class="control-group">
         <label class="control-label" for="inputPassword">Password</label>
         <div class="controls">
            <input type="password" name="password" id="inputPassword" placeholder="Password">
         </div>
      </div>
      <div class="control-group">
         <div class="controls">
            <button type="submit" class="btn btn-inverse">Sign in</button>
         </div>
      </div>
      <div class="control-group">
         <div class="controls">
            <a href="index.php" class="btn btn-link">Login with Facebook</a>
         </div>
      </div>
   </form>



   <?php
   		if(isset($_POST['login'])) {
   			if(validLoginData($_POST['email'], $_POST['password'])) {
   				// destination to be changed.
               $retrieve_user_data_sql = "SELECT * FROM users WHERE email = '" . $_POST['email'] . "' AND password = '" 
               . $_POST['password'] . "'";
               $res_tmp = mysql_query($retrieve_user_data_sql);
               if(mysql_num_rows($res_tmp) > 0) {
                  while($tmp = mysql_fetch_assoc($res_tmp)) {
                     $_SESSION['current_user_id'] = $tmp['id'];
                     $_SESSION['name'] = $tmp['name'];
                     $_SESSION['email_normal'] = $tmp['email'];
                     $_SESSION['image'] = $tmp['image'];
                  }
               }
   				header('Location: homepage.php');
   			} else {
   				echo "Wrong email/password combination.";
   			}
   		}
   ?>
</body>

</html>