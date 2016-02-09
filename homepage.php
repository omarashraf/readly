<html>

<head>
	<link rel="stylesheet" href="assets/css/bootmetro.css">
	<script src="assets/js/bootmetro.js"></script>
</head>



<body>

	<?php
      session_start();
      if(isset($_SESSION['FBID'])) {
         echo $_SESSION['EMAIL'] . ", " . $_SESSION['FULLNAME'] . "<br>" ;
         ?>
         <img src="http://graph.facebook.com/<?php echo $_SESSION['FBID']; ?>/picture">
         <?php
      }
   ?>

   <a href="logout.php" class="btn btn-link">Logout</a>

   
</body>

</html>