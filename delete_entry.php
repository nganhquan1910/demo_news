<!doctype html>
	 <html lang="en">
	 <head>
	 <meta charset="utf-8">
	 	 <title>Xóa bài viết.</title>
	 </head>
	 <body>
	 <h1>Xóa bài viết.</h1>
	 <?php // Script 12.7 - delete_entry.php
	 /* This script deletes a blog entry. */
	
	 // Connect and select:
	 $dbc = mysqli_connect('localhost', 'root', '', 'bangtin');
	
	 if (isset($_GET['ID']) && is_numeric($_GET['ID']) ) { // Display the entry in a form:
	
	 // Define the query:
	 $query = "SELECT title, Content FROM bang_tintuc WHERE ID={$_GET['ID']}";
	 if ($r = mysqli_query($dbc, $query)) { // Run the query.
	 $row = mysqli_fetch_array($r); // Retrieve the information.
	
	 // Make the form:
	 print '<form action="delete_entry.php" method="post">
	 <p>Bạn có chắc rằng muốn xóa bài viết này?</p>
	 <p><h3>' . $row['title'] . '</h3>' .
	 $row['Content'] . '<br>
	 <input type="hidden" name="ID" value="' . $_GET['ID'] . '">
	 <input type="submit" name="submit" value="Xóa bài viết này!"></p>
	 </form>';
	
	 } else { // Couldn't get the information.
	 print '<p style="color: red;">Could not retrieve the blog entry because:<br>' . mysqli_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
	 }
	
	 } elseif (isset($_POST['ID']) && is_numeric($_POST['ID'])) { // Handle the form.
	
	 // Define the query:
	 $query = "DELETE FROM bang_tintuc WHERE ID={$_POST['ID']} LIMIT 1";
	 $r = mysqli_query($dbc, $query); // Execute the query.
	
	 // Report on the result:
	 if (mysqli_affected_rows($dbc) == 1) {
	 print '<p>Bài viết đã được xóa.</p>';
	 } else {
	 print '<p style="color: red;">Could not delete the blog entry because:<br>' .mysqli_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
	 }
	
	 } else { // No ID received.
	 print '<p style="color: red;">This page has been accessed in error.</p>';
	 } // End of main IF.
	
	 mysqli_close($dbc); // Close the connection.
	
	 ?>

     <div>
     <button><a href="http://localhost/dashboard/php-codehere/view_news.php">Quay về bảng tin</a></button>
     </div>
	 </body>
	 </html>