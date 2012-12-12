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
  $query = "SELECT *,(M.uid IS NULL) AS isBand FROM users U, locations L left join musicians M on U.uid=M.uid left join bands B on U.uid=B.uid WHERE U.lid=L.lid";
  $whereclause = "";
  
  if ( isset($_POST['namepart']) )
   $whereclause = $whereclause . "firstname ILIKE '%" . $_POST['namepart'] . "%' ";
  
  if ( isset($_POST['city']) ) {
   if ($whereclause!="") $whereclause = $whereclause . "AND ";
   $whereclause = $whereclause . "L.city ILIKE '" . $_POST['city'] . "' ";
  }
  
  if ( isset($_POST['state']) ) {
   if ($whereclause!="") $whereclause = $whereclause . "AND ";
   $whereclause = $whereclause . "L.state='" . $_POST['state'] . "' ";
  }
  
  if ($whereclause!="") $query = $query . " AND " . $whereclause;
  
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
  ?>
  <h2>Advanced Search: Result</h2>  
  
  <?php
  while($row = pg_fetch_array($result,NULL,PGSQL_ASSOC))  {
   echo "<div class='searchresult'>";
   
   echo "<span class='name ";
   if ($result['isBand']=="t") {
    echo "band'>" . $result['lastname'];
   } else {
    echo "musician'>" . $result['firstname'] . " " . $result['lastname'];
   }
   echo "</span>";
   
   echo "<span class='location'>" . $result['city'] . ", " . $result['state'];
   
   echo "</div>"; // end searchresult div
  }
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
     <?php echo listUSStates($state_values,"state","WI"); ?>
    </li>
   </ul>
   
   <input type="submit" text="Search" name="submit" value="submit" />
   <input type="reset" text="Reset" />
  </form>

 </body>

</html>
