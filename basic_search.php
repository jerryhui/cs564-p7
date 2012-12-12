<html>

 <head><title>CS 564 PHP Project Search Result Page</title></head>

 <body>
   <tr>
     <td colspan="2" align="center" valign="top">
      Here are the search results (searched by title):<br>
       <table border="1" width="75%">
        <tr>
         <td align="center" bgcolor="#cccccc"><b>Title</b></td>
         <td align="center" bgcolor="#cccccc"><b>Author</b></td>
         <td align="center" bgcolor="#cccccc"><b>Number of Copies</b></td>
        </tr>	
 <?php
   // First check the itemid to see if it has been set
  if (! isset($_POST['lastname'])) {
    echo "  <h3><i>Error, title not set to an acceptable value</i></h3>\n".
        " <a href=\"index.html\">Back to main page</a>\n".
	" </body>\n</html>\n";
    exit();
  }
  $lastname = $_POST['lastname'];
  // Connect to the Database
  pg_connect('dbname=cs564_f12 host=postgres.cs.wisc.edu') 
	or die ("Couldn't Connect ".pg_last_error()); 
  // Get category name and item counts
  $query = "SELECT * FROM instant_schema.users where lastname='".$lastname."'";
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
    echo "\n         <td align=\"center\">";
    echo "\n          ".$row['title'];
    echo "\n         </td>";
    echo "\n         <td align=\"center\">";

    echo "\n          ".$row['author'];
    echo "\n         </td>";
    echo "\n         <td align=\"center\">";
    echo "\n          ".$row['num'];
    echo "\n         </td>";
    echo "\n        </tr>";
  }
  pg_close();
?>
 </table>
     </td>
    </tr>
        <?php echo "<a href=\"https://cs564.cs.wisc.edu/halit/index.html\">Back to main page</a>\n"?>
 </body>

</html>
