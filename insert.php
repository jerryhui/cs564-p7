<html>

 <head>
<title>CS 564 PHP Project Insert Result Page</title>
<link rel="stylesheet" type="text/css" href="instantFest.css" />
</head>

 <body>      

<h2>Create new user</h2>
<?php include 'menu.php'; ?>	
 <?php
   // First make sure that all the requested user information has been set
  if (!isset($_POST['lastname']) ) {
    echo "  <h3><i>Error, Last name not set to an acceptable value</i></h3>\n".
        " <a href=\"index.html\">Back to main page</a>\n".
	" </body>\n</html>\n";
    exit();
  }

  if (!isset($_POST['firstname']) ) {
    echo " <h3><i>Error, First name not set to an acceptable value</i></h3>\n".
	" <a href=\"index.html\">Back to main page</a>\n".
	" </body>\n</html>\n";
    exit();
  }

  if (!isset($_POST['email']) ) {
    echo " <h3><i>Error, Email not set to an acceptable value</i></h3>\n".
    	" <a href=\"index.html\">Back to main page</a>\n".
	" </body>\n</html>\n";
  }

  if (!isset($_POST['usertype']) ){
     echo " <h3><i>Error, User Type not set to an acceptable value</i></h3>\n".
	" <a href=\"index.html\">Back to main page</a>\n".
	" </body>\n</html>\n";
  }
  

  $firstname = str_replace("'","''",$_POST['firstname']);
  $lastname = str_replace("'","''",$_POST['lastname']);
  $email = str_replace("'","''",$_POST['email']);
  $about = str_replace("'","''",$_POST['about']);
  $usertype = $_POST['usertype'];

  // Connect to the Database
  pg_connect('dbname=cs564_f12 host=postgres.cs.wisc.edu') 
	or die ("Couldn't Connect ".pg_last_error()); 

  // Build insert string
  $query = "insert into instant_schema.users(firstname, lastname, email";
  if ( strlen($about)) {
  	$query .= ", about)";
  }else {
	$query .= ")";
  }
  $query .= " VALUES ('$firstname', '$lastname', '$email'";
  if ( strlen($about) ) {
	$query .= ", '$about');";
  }else {
        $query .= ");";
  }

  // Execute the query (users insertion) and check for errors
  $result = pg_query($query);
  if (!$result) {
    $errormessage = pg_last_error();
    echo "Error with insertion: " . $errormessage;
    exit();
  }

  // get uid of newly inserted user
  $uidrec = pg_query("select uid from instant_schema.users where lastname 
= '$lastname' AND firstname = '$firstname';");
  if (!$uidrec) {
  	$errormessage = pg_last_error();
  	echo "Error processing user type: $errormessage";
  	exit();
  }
  $uid = pg_fetch_array($uidrec);
  	
  if($usertype == "musician"){
	$result = pg_query("insert into instant_schema.musicians(uid) VALUES ({$uid['uid']})");
  }
  else{
	$result = pg_query("insert into instant_schema.bands(uid) VALUES ({$uid['uid']})");
  }
 if (!$result) {
    	$errormessage = pg_last_error();
    	echo "Error with insertion: $errormessage";
    	exit();
  } 
	
  echo "  <h3>Insert Successful</h3>";
  echo "$firstname $lastname was added (uid={$uid['uid']})";
  
  pg_close();
?>

        <?php echo "<a href=\"index.php\">Back to main page</a>\n"?>
 </body>

</html>
