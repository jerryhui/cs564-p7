<html>

 <head>
  <title>Browse all users: CS 564-Instant Music Festival</title>
  <link rel="stylesheet" type="text/css" href="instantFest.css" />
 </head>

 <body>
  <h1>Instant Music Festival</h1>
  <?php include 'menu.php'; ?>
  <?php include 'util.php'; ?>
  
  <?php
  
 if ( isset($_POST['submit']) ) {
  // build query
  $query = "SELECT DISTINCT *,(M.uid IS NULL) AS isband
  FROM instant_schema.users U
  left join instant_schema.locations L on U.lid=L.lid
  left join instant_schema.musicians M on U.uid=M.uid
  left join instant_schema.bands B on U.uid=B.uid";
  $whereclause = "";
  $searchCriteria = "";
  
  if ( isset($_POST['namepart']) && trim($_POST['namepart'])!="" ) {
   $whereclause = $whereclause . "(firstname ILIKE '%" . str_replace("'","''",$_POST['namepart']) . "%' 
   OR lastname ILIKE '%" . str_replace("'","''",$_POST['namepart']) ."%') ";
   
   $searchCriteria = $searchCriteria . "whose names contain " . $_POST['namepart']. " ";
  }
  
  if ( isset($_POST['city']) && trim($_POST['city'])!="" ) {
   if ($whereclause!="") $whereclause = $whereclause . "AND ";
   $whereclause = $whereclause . "L.city ILIKE '" . str_replace("'","''",$_POST['city']) . "' ";

   $searchCriteria = $searchCriteria . "in city " . $_POST['city']. " ";
  }
  
  if ( isset($_POST['state']) && $_POST['state']!=' ') {
   if ($whereclause!="") $whereclause = $whereclause . "AND ";
   $whereclause = $whereclause . "L.state='" . $_POST['state'] . "' ";

   $searchCriteria = $searchCriteria . "in the state of " . $state_values[$_POST['state']]. " ";
  }
  
  if ($whereclause!="") $query = "$query WHERE $whereclause";
  $query = $query . " ORDER BY isBand,lastname";
  
  // debug only!! print out SQL
  // echo "<p>SQL to execute: " . $query . "</p>";
  
  
  // Connect to the Database
  pg_connect('dbname=cs564_f12 host=postgres.cs.wisc.edu') 
    or die ("Couldn't Connect ".pg_last_error());
  
// Execute the query and check for errors
  $result = pg_query($query);
  if (!$result) {
    $errormessage = pg_last_error();
    echo "Error with query: " . $errormessage;
    exit();
  }
  
  echo "<h2>Advanced Search: Result</h2>";
  if ($searchCriteria!="")
   echo "<p>Listing musicians/bands " . trim($searchCriteria) . ".</p>";
  
  if (pg_num_rows($result)==0) {
   echo "<p>No users found.</p>";
  } else {

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
  
  } // end else
  ?>
  
  <h3>Search again</h3>
  <?php
  
  pg_close();  
  } else {
   ?>
   
  <h2>Advanced Search</h2>
  <p>Please enter one or more search criteria. All text is case-insensitive.</p>
  <?php
 }
  ?>
  <div class="searchform">
  <form method="post" action="advanced_search.php">
   
   <ul>
    <li>
     <span>Name (first, last, or band name; partial name accepted)</span>
     <input type="text" name="namepart" title="Enter part of the name of the musicians or bands to search for." />
    </li>
    
    <li>
     <span>City</span>
     <input type="text" name="city" title="Enter the full name of the city." />
    </li>
    
    <li>
     <span>State</span>
     <?php echo listUSStates($state_values,"state","--"); ?>
    </li>
    
    <li>
     <input type="submit" text="Search" name="submit" value="submit" />
     <input type="reset" text="Reset" />
    </li>
   </ul>
   
  </form>
  </div>

 </body>

</html>
