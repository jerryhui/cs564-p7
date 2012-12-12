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
    <th>Facebook</th>
    <th>LinkedIn</th>
    <th>Website</th>
   </tr>
  
  <?php
  // Connect to the Database
  pg_connect('dbname=cs564_f12 host=postgres.cs.wisc.edu') 
	or die ("Couldn't Connect ".pg_last_error()); 
  // Get category name and item counts
  $query = "SELECT * FROM instant_schema.users as U, instant_schema.musicians as M where U.uid=M.uid";
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
    if ($row['email']!="") echo "\n          <a href=\"mailto:".$row['email']."\"><img src='icon_email.gif' title='".$row['email']."' /></a>";
    echo "\n         </td>";
    echo "\n         <td>";
    if ($row['fbid']!="") echo "\n          <a href=\"http://facebook.com/".$row['fbid']."\"><img src='facebook_icon.png' title='".$row['fbid']."' /></a>";
    echo "\n         </td>";
    echo "\n         <td>";
    if ($row['linkedin']!="") echo "\n          <a href=\"".$row['linkedin']."\"><img src='linkedin.png' title='".$row['linkedin']."' /></a>";
    echo "\n         </td>";
    echo "\n         <td>";
    if ($row['website']!="") echo "\n          <a href=\"".$row['website']."\">".$row['website']."</a>";
    echo "\n         </td>";
    echo "\n        </tr>";
  }
  pg_close();
?>
  </table>
  
  <h2>Bands</h2>
 </body>

</html>
