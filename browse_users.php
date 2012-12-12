<html>

<head>
  <title>Browse all users: CS 564-Instant Music Festival</title>
  <link rel="stylesheet" type="text/css" href="instantFest.css" />
 </head>

 <body>
  <h1>Instant Music Festival</h1>
  <h2>Musicians</h2>
  
  <table class="usertable">
   <tr>
    <th>Name</th>
    <th>Email</th>
    <th>Location</th>
    <th>Facebook</th>
    <th>LinkedIn</th>
    <th>Website</th>
    <th>About</th>
   </tr>
  
  <?php
  // Connect to the Database
  pg_connect('dbname=cs564_f12 host=postgres.cs.wisc.edu') 
	or die ("Couldn't Connect ".pg_last_error()); 
  // Get category name and item counts
  $query = "SELECT * FROM instant_schema.users as U, instant_schema.musicians as M, instant_schema.locations as L where U.uid=M.uid and U.lid=L.lid order by U.lastname";
  // Execute the query and check for errors
  $result = pg_query($query);
  if (!$result) {
    $errormessage = pg_last_error();
    echo "Error with query: " . $errormessage;
    exit();
  }
  
  
  // get each row and print it out  
  while($row = pg_fetch_array($result,NULL,PGSQL_ASSOC))  {
    echo "        <tr>";
    echo "\n         <td>";
    echo "\n          ".$row['firstname']." ".$row['lastname'];
    echo "\n         </td>";
    echo "\n         <td>";
    if ($row['email']!="") echo "\n          <a href=\"mailto:".$row['email']."\" class='icon email'><span> </span></a>";
    echo "\n         </td>";
    echo "\n         <td>";
    echo "\n          ".$row['city'].", ".$row['state'];
    echo "\n         </td>";
    echo "\n         <td>";
    if ($row['fbid']!="") echo "\n          <a href=\"http://facebook.com/".$row['fbid']."\" class='icon fb'><span> </span></a>";
    echo "\n         </td>";
    echo "\n         <td>";
    if ($row['linkedin']!="") echo "\n          <a href=\"".$row['linkedin']."\" class='icon linkedin'><span> </span></a>";
    echo "\n         </td>";
    echo "\n         <td>";
    if ($row['website']!="") echo "\n          <a href=\"".$row['website']."\">".$row['website']."</a>";
    echo "\n         </td>";
    echo "\n         <td>";
    echo "\n          ".$row['about'];
    echo "\n         </td>";
    echo "\n        </tr>";
  }
?>
  </table>
  
  <h2>Bands</h2>
  <table class="usertable">
   <tr>
    <th>Name</th>
    <th>Email</th>
    <th>Location</th>
    <th>Facebook</th>
    <th>LinkedIn</th>
    <th>Website</th>
    <th>Influence</th>
   </tr>

<?php
  // Get category name and item counts
  $query = "SELECT * FROM instant_schema.users as U, instant_schema.bands as B, instant_schema.locations as L where U.uid=B.uid and U.lid=L.lid order by U.lastname";
  // Execute the query and check for errors
  $result = pg_query($query);
  if (!$result) {
    $errormessage = pg_last_error();
    echo "Error with query: " . $errormessage;
    exit();
  }
  
  
  // get each row and print it out  
  while($row = pg_fetch_array($result,NULL,PGSQL_ASSOC))  {
    echo "        <tr>";
    echo "\n         <td>";
    echo "\n          ".$row['lastname'];
    echo "\n         </td>";
    echo "\n         <td>";
    if ($row['email']!="") echo "\n          <a href=\"mailto:".$row['email']."\" class='icon email'><span> </span></a>";
    echo "\n         </td>";
    echo "\n         <td>";
    echo "\n          ".$row['city'].", ".$row['state'];
    echo "\n         </td>";
    echo "\n         <td>";
    if ($row['fbid']!="") echo "\n          <a href=\"http://facebook.com/".$row['fbid']."\" class='icon fb'><span> </span></a>";
    echo "\n         </td>";
    echo "\n         <td>";
    if ($row['linkedin']!="") echo "\n          <a href=\"".$row['linkedin']."\" class='icon linkedin'><span> </span></a>";
    echo "\n         </td>";
    echo "\n         <td>";
    if ($row['website']!="") echo "\n          <a href=\"".$row['website']."\">".$row['website']."</a>";
    echo "\n         </td>";
    echo "\n         <td>";
    echo "\n          ".$row['soundslike'];
    echo "\n         </td>";
    echo "\n        </tr>";
  }
?>   
  </table>
<?php  
  pg_close();
?>
 </body>

</html>
