<html>

<head>
	<link rel="stylesheet" href="assets/css/bootmetro.css">
	<link rel="stylesheet" href="rating.css">
	<script src="assets/js/bootmetro.js"></script>
</head>



<body>
	<?php
		include('helper_functions.php');
		session_start();

		$book_id = $_GET['book_id'];
		$get_book_info_sql = "SELECT * FROM books WHERE id = " . $book_id;
		$res_books = mysql_query($get_book_info_sql);
		if(mysql_num_rows($res_books) > 0) {
			while($tmp = mysql_fetch_assoc($res_books)) {
				echo $tmp['title'] . "<br>";
				echo $tmp['description'] . "<br>";
				echo $tmp['rating'] . "<br>";
				echo $tmp['genre'] . "<br>";
				echo "<img src='" . $tmp['image'] ."'>" . "<br>";
			}
		}
		$get_author_book_sql = "SELECT * FROM books_authors INNER JOIN authors ON books_authors.author_id = authors.id";
		$res_author_books = mysql_query($get_author_book_sql);
		if(mysql_num_rows($res_author_books) > 0) {
			while($tmp = mysql_fetch_assoc($res_author_books)) {
				if($tmp['book_id'] == $_GET['book_id']) {
					echo "<a href='author.php?author_id=" . $tmp['id'] . "'>" . $tmp['name'] . "</a><br>";
				}
			}
		}
	?>
</body>

</html>