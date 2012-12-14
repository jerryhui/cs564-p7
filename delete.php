<html>

 <head><title>CS 564 PHP Project Delete Result Page</title></head>

 <body>      
	
 <?php
   // First make sure that all the requested user information has been set
  if ((!isset($_POST['lastname']) && strlen((trim($_POST['lastname']))))) {
    echo "  <h3><i>Error, Last name not set to an acceptable value</i></h3>\n".
        " <a href=\"index.html\">Back to main page</a>\n".
	" </body>\n</html>\n";
    exit();
  }

  $firstname = trim($_POST['firstname']);
  $lastname = $_POST['lastname'];

  str_replace("'", "''", $firstname);
  str_replace("'", "''", $lastname);

  // Connect to the Database
  pg_connect('dbname=cs564_f12 host=postgres.cs.wisc.edu') 
	or die ("Couldn't Connect ".pg_last_error()); 

  // Build delete string
  $query = "delete from instant_schema.users WHERE ";
  if ( strlen($firstname)) {
  	$query .= "firstname = '$firstname' AND ";
  }
  $query .= "lastname = '$lastname';";
  
  // Execute the query (deletion) and check for errors
  $result = pg_query($query);
  if (!$result) {
    $errormessage = pg_last_error();
    echo "Error with insertion: " . $errormessage;
    exit();
  }
  echo "  <h3>Delete Successful</h3>";
  
  pg_close();
?>

        <?php echo "<a href=\"index.html\">Back to main page</a>\n"?>
 </body>

</html>
