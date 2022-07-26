<!doctype html>
	 <html lang="en">
	 <head>
	 <meta charset="utf-8">
	 	 <title>Sửa bài viết</title>
	 </head>
	 <body>
	 <h1>Sửa bài viết</h1>
	 <?php // Script 12.8 - edit_entry.php
	 /* This script edits a blog entry using an UPDATE query. */
	
	 // Connect and select:
	 $dbc = mysqli_connect('localhost', 'root', '', 'bangtin');
	
	 //Set the character set:
	 mysqli_set_charset($dbc, 'utf8');
	
	 if (isset($_GET['ID']) && is_numeric($_GET['ID']) ) { // Display the entry in a form:
	
	 // Define the query.
	 $query = "SELECT title, Content FROM bang_tintuc WHERE ID={$_GET['ID']}";
	 if ($r = mysqli_query($dbc, $query)) { // Run the query.
	
	 $row = mysqli_fetch_array($r); // Retrieve the information.
	 // Make the form:
	 print '<form action="edit_entry.php" method="post">
	 <p>Tiêu đề: <input type="text" name="title" size="40" maxsize="100" value="' .htmlentities($row['title']) . '"></p>
	 <p>Nội dung: <textarea name="Content" cols="40" rows="5">' . htmlentities($row['Content']). '</textarea></p>
	 <input type="hidden" name="ID" value="' . $_GET['ID'] . '">
	 <input type="submit" name="submit" value="Cập nhật bài viết!">
	 </form>';
	
	 } else { // Couldn't get the information.
	 print '<p style="color: red;">Could not retrieve the blog entry because:<br>' .mysqli_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
	 }
	
	 } elseif (isset($_POST['ID']) && is_numeric($_POST['ID'])) { // Handle the form.
	
	 // Validate and secure the form data:
	 $problem = FALSE;
	 if (!empty($_POST['title']) && !empty($_POST['Content'])) {
	 $title = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['title'])));
	 $Content = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['Content'])));
	 } else {
	 print '<p style="color: red;">Please submit both a title and an entry.</p>';
	 $problem = TRUE;
	 }
	
	 if (!$problem) {
	
	 // Define the query.
	 $query = "UPDATE Content SET title='$title', Content='$Content' WHERE ID={$_POST['ID']}";
	 $r = mysqli_query($dbc, $query); // Execute the query.
	
	 // Report on the result:
	 if (mysqli_affected_rows($dbc) == 1) {
	 print '<p>Bài viết đã được chỉnh sửa.</p>';
	 } else {
	 print '<p style="color: red;">Could not update the entry because:<br>' . mysqli_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
	 }
	
	 } // No problem!
	
	 } else { // No ID set.
	 print '<p style="color: red;">This page has been accessed in error.</p>';
	 } // End of main IF.
	
	 mysqli_close($dbc); // Close the connection.
	
	 ?>
	 <br>
	 <div>
	 <button><a href="http://localhost/dashboard/php-codehere/view_news.php">Quay về bảng tin</a></button>
	 </div>
	 </body>
	 </html>