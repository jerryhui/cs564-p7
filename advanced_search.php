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
  FROM instant_schema.locations L, instant_schema.users U
  left join instant_schema.musicians M on U.uid=M.uid
  left join instant_schema.bands B on U.uid=B.uid
  WHERE U.lid=L.lid";
  $whereclause = "";
  
  if ( isset($_POST['namepart']) && trim($_POST['namepart'])!="" ) {
   $whereclause = $whereclause . "(firstname ILIKE '%" . $_POST['namepart'] . "%' 
   OR lastname LIKE '%" . $_POST['namepart'] ."%' ";
  }
  
  if ( isset($_POST['city']) && trim($_POST['city'])!="" ) {
   if ($whereclause!="") $whereclause = $whereclause . "AND ";
   $whereclause = $whereclause . "L.city ILIKE '" . $_POST['city'] . "' ";
  }
  
  if ( isset($_POST['state']) && $_POST['state']!=' ') {
   if ($whereclause!="") $whereclause = $whereclause . "AND ";
   $whereclause = $whereclause . "L.state='" . $_POST['state'] . "' ";
  }
  
  if ($whereclause!="") $query = $query . " AND " . $whereclause;
  $query = $query . " ORDER BY isBand,lastname";
  
  // debug only!! print out SQL
  echo "<p>SQL to execute: " . $query . "</p>";
  
  
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
  
  if (pg_num_rows($result)==0) {
   echo "<p>No users found.</p>";
  } else {
  ?>
  <h2>Advanced Search: Result</h2>  
  
  <?php
   while($row = pg_fetch_array($result,NULL,PGSQL_ASSOC))  {
    echo "<div class='searchresult'>";
    
    echo "<span class='name ";
    if ($row['isband']=="t") {
     echo "band'>" . $row['lastname'];
    } else {
     echo "musician'>" . $row['firstname'] . " " . $row['lastname'];
    }
    echo "</span>";
    
    echo "<span class='location'>" . $row['city'] . ", " . $row['state'] . "</span>";
    
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
  
  <?php
 }
  ?>
  <form method="post" action="advanced_search.php" class="searchform">
   
   <ul>
    <li>
     <span>Name (first, last, or band name)</span>
     <input type="text" name="namepart" />
    </li>
    
    <li>
     <span>City</span>
     <input type="text" name="city" />
    </li>
    
    <li>
     <span>State</span>
     <?php echo listUSStates($state_values,"state","--"); ?>
    </li>
   </ul>
   
   <input type="submit" text="Search" name="submit" value="submit" />
   <input type="reset" text="Reset" />
  </form>

 </body>

</html>
