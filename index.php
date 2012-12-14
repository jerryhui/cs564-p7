<html>

 <head>
  <link rel="stylesheet" type="text/css" href="instantFest.css" />
  <title>CS 564 PHP Project-7: Instant Music Festival</title>
 </head>

 <body>

 <h2>CS 564 PHP Project-7: Instant Music Festival</h2>
 <?php include 'menu.php' ?>
  <h3>Search for a User</h3>
  Enter a last name of a musician, or a band name (exact name only):
  <table width="30%" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
    <form name="form1" method="post" action="basic_search.php">
      <tr align="center">
        <td height="30" class="deepred" width="48%"><font face="Times New Roman, Times, serif">Name</font></td>
        <td height="30" class="deepred" width="52%"><input type="text" name="lastname">
        </td>
      </tr>
      <tr>
        <td height="24" align="center" width="48%">
        </td>
        <td align="center" width="52%"><input type="submit" name="Submit" value="Submit"><input type="reset" name="Submit2" value="Reset">
        </td>
      </tr>
    </form>
  </table>
  
  <h3><a href="advanced_search.php">Advanced Search</a></h3>
  <p>Find a user by type (individual musician/band), name, location, or other criteria.</p>
  
  <h3><a href="update.php">Update Users</a></h3>
  <p>Modify user info, create new user, or delete users.</p>

  <h3><a href="browse_users.php">Browse All Users</a></h3>
  <p>See a list of musicians and bands registered on our site!</p>
</body>

</html>