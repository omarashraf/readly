<html>

<head>
	<link rel="stylesheet" href="assets/css/bootmetro.css">
	<script src="assets/js/bootmetro.js"></script>
</head>



<body>
   <?php
      include('helper_functions.php');
      session_start();

      if(count($_SESSION['search_books']) == 0 && count($_SESSION['search1']) == 0 && count($_SESSION['search2']) == 0
         && count($_SESSION['search_authors']) == 0) {
         echo "No search matcehs were found.";
      }
      else {
         if(!empty($_SESSION['search1']) && !empty($_SESSION['search2'])) {
            echo "<h3>Search results for books</h3>";
            $tmp_books = $_SESSION['search1'];
            for ($i = 0; $i < count($_SESSION['search1']); $i++) {
               $select_books_sql = "SELECT * FROM books WHERE id = " . $tmp_books[$i];
               $books_res = mysql_query($select_books_sql);
               if(mysql_num_rows($books_res)) {
                  while ($tmp = mysql_fetch_assoc($books_res)) {
                     echo "<a href='book.php?book_id=" . $tmp['id'] . "'>" . $tmp['title'] . "</a><br>";
                  }
               }
            }
            echo "<h3>Search results for authors</h3>";
            $tmp_authors = $_SESSION['search2'];
            for ($i = 0; $i < count($_SESSION['search2']); $i++) {
               $select_authors_sql = "SELECT * FROM authors WHERE id = " . $tmp_authors[$i];
               $authors_res = mysql_query($select_authors_sql);
               if(mysql_num_rows($authors_res)) {
                  while ($tmp = mysql_fetch_assoc($authors_res)) {
                     echo "<a href='author.php?author_id=" . $tmp['id'] . "'>" . $tmp['name'] . "</a><br>";
                  }
               }
            }
            $_SESSION['search1'] = array();
            $_SESSION['search2'] = array();
         }
         else {
            if(!empty($_SESSION['search_authors'])) {
               echo "<h3>Search results:</h3> ";
               $tmp_authors = $_SESSION['search_authors'];
               for ($i = 0; $i < count($_SESSION['search_authors']); $i++) {
                  $select_authors_sql = "SELECT * FROM authors WHERE id = " . $tmp_authors[$i];
                  $authors_res = mysql_query($select_authors_sql);
                  if(mysql_num_rows($authors_res)) {
                     while ($tmp = mysql_fetch_assoc($authors_res)) {
                        echo "<a href='author.php?author_id=" . $tmp['id'] . "'>" . $tmp['name'] . "</a><br>";
                     }
                  }
               }
               $_SESSION['search_authors'] = array();
            }
            else {
               echo "<h3>Search results:</h3> ";
               $tmp_books = $_SESSION['search_books'];
               for ($i = 0; $i < count($_SESSION['search_books']); $i++) {
                  $select_books_sql = "SELECT * FROM books WHERE id = " . $tmp_books[$i];
                  $books_res = mysql_query($select_books_sql);
                  if(mysql_num_rows($books_res)) {
                     while ($tmp = mysql_fetch_assoc($books_res)) {
                        echo "<a href='book.php?book_id=" . $tmp['id'] . "'>" . $tmp['title'] . "</a><br>";
                     }
                  }
               }
               $_SESSION['search_books'] = array();
            }
         }  
      }
   ?>	
</body>

</html>