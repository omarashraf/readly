<html>

<head>
	<link rel="stylesheet" href="assets/css/bootmetro.css">
	<script src="assets/js/bootmetro.js"></script>
</head>



<body>
	<?php
		include('helper_functions.php');
		session_start();

		$author_id = $_GET['author_id'];
		$get_author_info_sql = "SELECT * FROM authors WHERE id = " . $author_id;
		$res_authors = mysql_query($get_author_info_sql);
		if(mysql_num_rows($res_authors) > 0) {
			while($tmp = mysql_fetch_assoc($res_authors)) {
				echo $tmp['name'] . "<br>";
				echo $tmp['brief'] . "<br>";
				echo "<img src='" . $tmp['image'] ."'>" . "<br>";
			}
		}
		$get_author_books_sql = "SELECT * FROM books_authors INNER JOIN books ON books_authors.book_id = books.id";
		$res_author_books = mysql_query($get_author_books_sql);
		if(mysql_num_rows($res_author_books) > 0) {
			while($tmp = mysql_fetch_assoc($res_author_books)) {
				if($tmp['author_id'] == $_GET['author_id']) {
					//echo $tmp['id'] . "<br>";
					echo "<a href='book.php?book_id=" . $tmp['id'] . "'>" . $tmp['title'] . "</a><br>";
				}
			}
		}
	?>
</body>

</html>