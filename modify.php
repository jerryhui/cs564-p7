<html>

 <head><title>CS 564 PHP Project Modify Result Page</title></head>

 <body>      
	
 <?php
   // First check the itemid to see if it has been set
  if (!isset($_POST['lastname']) ) {
    echo "  <h3><i>Error, lastname not set to an acceptable value</i></h3>\n".
        " <a href=\"https://cs564.cs.wisc.edu/halit/index.html\">Back to main page</a>\n".
	" </body>\n</html>\n";
    exit();
  }
  $lastname = $_POST['lastname'];
  $firstname = $_POST['firstname'];
  $email = $_POST['email'];
  $about = $_POST['about'];

  str_replace("'", "''", $lastname);
  str_replace("'", "''", $firstname);
  str_replace("'", "''", $email);
  str_replace("'", "''", $about);

 // Connect to the Database
  pg_connect('dbname=cs564_f12 host=postgres.cs.wisc.edu') 
	or die ("Couldn't Connect ".pg_last_error()); 

  // Get category name and item counts
  if( strlen($firstname) > 0 || strlen($email) > 0 || strlen($about) > 0 )	{
	$query = "UPDATE instant_schema.users set";
	if( strlen($firstname) )	{
	$query .= " firstname='".$firstname."'";
	}
	if( strlen($email) && strlen($about) )	{
	$query .= ",";
	}
	if( strlen($email) )	{
	$query .= " email='".$email."'";
	}
	if( strlen($about) )	{
	$query .= ", about='".$about."'";
	}
	$query .= " where lastname='".$lastname."'";
  }else	{
    echo "  <h3><i>no field to be updated</i></h3>\n".
        " <a href=\"index.html\">Back to main page</a>\n".
	" </body>\n</html>\n";
    exit();
  }
  // Execute the query and check for errors
  echo $query;

  $result = pg_query($query);
  if (!$result) {
    $errormessage = pg_last_error();
    echo "Error with query: " . $errormessage;
    exit();
  }
  echo "  <h3>Update Successful</h3>";
  
  pg_close();
?>

        <?php echo "<a href=\"index.php\">Back to main page</a>\n"?>
 </body>

</html>
