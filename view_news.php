	 <!doctype html>
	 <html lang="en">
	 <head>
	    <meta charset="utf-8">
	 	<title>Demo News</title>
	 </head>
	 <body>
	    <h1 style="text-align: center">Demo Bảng tin</h1>
	    <?php // Script 12.6 - view_entries.php
	    /* This script retrieves blog entries from the database. */
	
	    // Connect and select:
	    $dbc = mysqli_connect('localhost', 'root', '', 'bangtin');
     	 // Define the query:
	    $query = 'SELECT * FROM bang_tintuc ORDER BY ID DESC';
	
	    if ($r = mysqli_query($dbc, $query)) { // Run the query.
	
	 // Retrieve and print every record:
	    while ($row = mysqli_fetch_array($r)) {
	    print "<p><h3>{$row['title']}</h3>
	    {$row['Content']}<br><br>
	    <a href=\"edit_entry.php?ID={$row['ID']}\">Sửa bài viết.</a>
	    <a style=\"background-color: red; color: white\" href=\"delete_entry.php?ID={$row['ID']}\">Xóa bài viết!</a>
	    </p><hr>\n";
	    }
	
	    } else { // Query didn't run.
	    print '<p style="color: red;">Could not retrieve the data because:<br>' . mysqli_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
	    } // End of query IF.
	
	    mysqli_close($dbc); // Close the connection.
	
	 ?>

        <div>
            <button><a href="http://localhost/dashboard/php-codehere/add_entry.php">Thêm bài viết.</a></button>
        </div>
	 </body>
	 </html>