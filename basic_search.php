<html>

 <head>
  <title>Basic Search Results: CS 564-Instant Music Festival</title>
  <link rel="stylesheet" type="text/css" href="instantFest.css" />
 </head>

 <body>
<h2>Basic search: result</h2>
<?php include 'menu.php' ?>

      <p>Here are the search results (search by last name)</p>
 <?php
   // First check the itemid to see if it has been set
  if (! isset($_POST['lastname'])) {
    echo "  <h3><i>Error, last name not set to an acceptable value</i></h3>\n".
        " <a href=\"index.html\">Back to main page</a>\n".
	" </body>\n</html>\n";
    exit();
  }
  $lastname = str_replace("'","''",$_POST['lastname']);
  // Connect to the Database
  pg_connect('dbname=cs564_f12 host=postgres.cs.wisc.edu') 
	or die ("Couldn't Connect ".pg_last_error()); 
  // Get category name and item counts
  $query = "SELECT DISTINCT *,(M.uid IS NULL) AS isband
  FROM instant_schema.users U
  left join instant_schema.locations L on U.lid=L.lid
  left join instant_schema.musicians M on U.uid=M.uid
  left join instant_schema.bands B on U.uid=B.uid
  WHERE lastname='$lastname'";
  // Execute the query and check for errors
  $result = pg_query($query);
  if (!$result) {
    $errormessage = pg_last_error();
    echo "Error with query: " . $errormessage;
    exit();
  }
  
  
  // get each row and print it out  
  while($row = pg_fetch_array($result,NULL,PGSQL_ASSOC))  {
    echo "<div class='searchresult'>";
    
    echo "<span class='name ";
    if ($row['isband']=="t") {
     echo "band'>" . $row['lastname'];
    } else {
     echo "musician'>" . $row['firstname'] . " " . $row['lastname'];
    }
    echo "</span>";
    
    if ($row['city']!="") echo "<span class='location'>" . $row['city'] . ", " . $row['state'] . 
"</span>";
    
    // contact info
    echo "<div class='contacts'>";
    if ($row['email']!="") echo "<span class='email'><a href='mailto:" . $row['email'] . "' class='icon email'><span> <span></a></span>";
    if ($row['isband']=="f") {
     // display musician-specific info
     if ($row['fbid']!="") echo "<span class='facebooklink'><a href='http://facebook.com/" . $row['fbid'] . "' class='icon fb'><span> </span></a></span>";
     if ($row['website']!="") echo "<span class='webpage'><a href='http://" . $row['website'] . "' target='_blank'>". $row['website'] ."</a></span>";
     echo "</div>"; // end contacts
    } else {
     echo "</div>"; // end contacts
     if ($row['soundslike']!="") echo "<span class='influence'>Sounds like: <p>" . $row['soundslike'] . "</p></span>";
     if ($row['memberlist']!="") echo "<span class='memberlist'>Members: <p>" . $row['memberlist'] . "</p></span>";
    }
    if ($row['about']!="") echo "<p class='about'>" . $row['about'] . "</p>";
    
    echo "</div>"; // end searchresult div
   }
  pg_close();
?>
        <?php echo "<a href=\"index.php\">Back to main page</a>\n"?>
 </body>

</html>
