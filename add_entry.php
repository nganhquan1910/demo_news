	 <!doctype html>
	 <html lang="en">
	 <head>
	 <meta charset="utf-8">
	 	 <title>Thêm bài viết</title>
	 </head>
	 <body>
	 <h1>Thêm bài viết</h1>
	 <?php // Script 12.4 - add_entry.php
	 /* This script adds a blog entry to the database. */
	
	 if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.
	
	 // Validate the form data:
	    $problem = FALSE;
	    if (!empty($_POST['title']) && !empty($_POST['Content'])) {
	        $title = trim(strip_tags($_POST['title']));
	        $Content = trim(strip_tags($_POST['Content']));
	    } else {
	        print '<p style="color: red;">Please submit both a title and an entry.</p>';
	        $problem = TRUE;
	    }
	
	    if (!$problem) {
	
	    // Connect and select:
	    $dbc = mysqli_connect('localhost', 'root', '', 'bangtin');
	    // Define the query:
	    $query = "INSERT INTO bang_tintuc (ID, title, date, Content) VALUES ('', '$title', NOW(), '$Content')";
	
	    // Execute the query:
	        if (@mysqli_query($dbc, $query)) {
	            print '<p>Bài viết đã được thêm vào!</p>';
	        } else {
	            print '<p style="color: red;">Could not add the entry because:<br>' . mysqli_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
	        }
	
	 mysqli_close($dbc); // Close the connection.
	
	 } // No problem!
	
	 } // End of form submission IF.
	
	 // Display the form:
	 ?>
	 <form action="add_entry.php" method="post">
	 <p>Tiêu đề: <input type="text" name="title" size="40" maxsize="100"></p>
	 <p>Nội dung: <textarea name="Content" cols="40" rows="5"></textarea></p>
	 <input type="submit" name="submit" value="Đăng bài này!"><br><br>
     <button><a href="http://localhost/dashboard/php-codehere/view_news.php">Quay về bảng tin.</a></button>
	 </form>

	 </body>
	 </html>