<html>

<head>
	<link rel="stylesheet" href="assets/css/bootmetro.css">
   <link rel="stylesheet" href="assets/css/bootmetro-icons.css">
	<script src="assets/js/bootmetro.js"></script>
   <script type="text/javascript">
      function add_shelf() {
         if(document.getElementById('shelf').value == '') {
            alert('Shelf name can\'t be blank!');
         }
      }
      function search_is_empty() {
         if(document.getElementById('searchField').value == '') {
            alert('Search field can\'t be empty.');
         }
      }
   </script>
</head>



<body>

   <div>
      <a href="homepage.php" class="btn btn-link">Readly</a>
      <form class="form-search" style="text-align: center;" method="post">
         <input type="hidden" name="search" id="search" value="1"></input>
         <div class="input-append">
            <input type="text" class="span8 search-query" placeholder="Search for books and authors" name="searchField" id="searchField">
            <button type="submit" class="btn"><i class="icon-search" onclick="search_is_empty()"></i></button>
         </div>
         <div style="margin-top: 10px;">
            <label class="checkbox inline">
              <input type="checkbox" name="books" id="books" value="books">
               <span class="metro-checkbox">Books</span>
            </label>
            <label class="checkbox inline">
              <input type="checkbox" name="authors" id="authors" value="authors">
               <span class="metro-checkbox">Authors</span>
            </label>
         </div>
      </form>
   </div>
	<?php
      include('helper_functions.php');
      session_start();

      if(isset($_POST['search']) && !empty($_POST['searchField'])) {
         $select_books_sql = "SELECT * FROM books";
         $res_books = mysql_query($select_books_sql);

         $select_authors_sql = "SELECT * FROM authors";
         $res_authors = mysql_query($select_authors_sql);


         if(isset($_POST['books']) && isset($_POST['authors'])) {

            $books_search_results = array();
            $authors_search_results = array();

            if(mysql_num_rows($res_books) > 0) {
               while($res = mysql_fetch_assoc($res_books)) {
                  if(strpos(strtolower($res['title']), strtolower($_POST['searchField'])) !== FALSE) {
                     array_push($books_search_results, $res['id']);
                  }
               }
               $_SESSION['search1'] = $books_search_results;
            }

            if(mysql_num_rows($res_authors) > 0) {
               while($res = mysql_fetch_assoc($res_authors)) {
                  if(strpos(strtolower($res['name']), strtolower($_POST['searchField'])) !== FALSE) {
                     array_push($authors_search_results, $res['id']);
                  }
               }
               $_SESSION['search2'] = $authors_search_results;
               header("Location: search_results.php");
            }
         } else {
            if(isset($_POST['authors'])) {
               // array of possible authors that the user searched for.
               $authors_search_results = array();
               if(mysql_num_rows($res_authors) > 0) {
                  while($res = mysql_fetch_assoc($res_authors)) {
                     if(strpos(strtolower($res['name']), strtolower($_POST['searchField'])) !== FALSE) {
                        array_push($authors_search_results, $res['id']);
                     }
                  }
                  $_SESSION['search_authors'] = $authors_search_results;
                  header("Location: search_results.php");
               }
            } else {
               if(isset($_POST['books'])) {
                  // array of possible books that the user searched for.
                  $books_search_results = array();
                  if(mysql_num_rows($res_books) > 0) {
                     while($res = mysql_fetch_assoc($res_books)) {
                        if(strpos(strtolower($res['title']), strtolower($_POST['searchField'])) !== FALSE) {
                           array_push($books_search_results, $res['id']);
                        }
                     }
                     $_SESSION['search_books'] = $books_search_results;
                     header("Location: search_results.php");
                  }
               }
            }
         }
         
      }

      if(isset($_SESSION['FBID'])) {
         if(!validFBLoginData($_SESSION['EMAIL'])) {
            $insert_FB_user_sql = "INSERT INTO users (name, email) VALUES ('" . $_SESSION['FULLNAME'] . "', '" . $_SESSION['EMAIL'] . "')";
            if(!mysql_query($insert_FB_user_sql)) {
               die("Error: " . mysql_error());
            }
         }
         $retrieve_FB_user_data_sql = "SELECT * FROM users WHERE name = '" . $_SESSION['FULLNAME'] . "'";
               $res_tmp = mysql_query($retrieve_FB_user_data_sql);
               if(mysql_num_rows($res_tmp) > 0) {
                  while($tmp = mysql_fetch_assoc($res_tmp)) {
                     $_SESSION['current_user_id'] = $tmp['id'];
                  }
               }
         echo $_SESSION['EMAIL'] . ", " . $_SESSION['FULLNAME'] . "<br>" ;
         ?>
         <img src="http://graph.facebook.com/<?php echo $_SESSION['FBID']; ?>/picture">
         <?php
      } else {
         echo "Hi " . $_SESSION['name'] . " whose email is: " . $_SESSION['email_normal'] . " and id --> " . $_SESSION['current_user_id'];
      }
   ?>

   <a href="logout.php" class="btn btn-link">Logout</a>
   <br><br>
   <h3>Create Shelf</h3>
   <form method="post">
      <input type="hidden" name="shelved" value='1'></input>
      <div class="controls">
         <input type="text" name="shelf" id="shelf" placeholder="Add a new shelf.."></input>
      </div>
      <div class="controls">
         <button type="submit" class="btn btn-primary" onclick="add_shelf()">Add shelf</button>
      </div>
   </form>

   <?php
      
      if(isset($_POST['shelved']) && isset($_POST['shelf']) && !empty($_POST['shelf'])) {
         $insert_shelf_sql = "INSERT INTO shelves (name, user_id) VALUES ('" . $_POST['shelf'] . "'," . $_SESSION['current_user_id'] . ")";
         if(!mysql_query($insert_shelf_sql)) {
            echo "An already existing shelf has the same name. <br>";
            //die("Error: " . mysql_error());
         }  
         else {
            echo "<script>alert('Shelf has been added');</script>";
         }
      }
   ?>
   
</body>

</html>