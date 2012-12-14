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
  <div class="searchform">
    <form name="form1" method="post" action="basic_search.php">
     <ul>
      <li>
        <span>Name</span>
        <input type="text" name="lastname">
      </li>
      <li>
        <input type="submit" name="Submit" value="Submit" /><input type="reset" name="Submit2" value="Reset" />
      </li>
     </ul>
    </form>
  </div>
  
  <h3><a href="advanced_search.php">Advanced Search</a></h3>
  <p>Find a user by type (individual musician/band), name, location, or other criteria.</p>
  
  <h3><a href="update.php">Update Users</a></h3>
  <p>Modify user info, create new user, or delete users.</p>

  <h3><a href="browse_users.php">Browse All Users</a></h3>
  <p>See a list of musicians and bands registered on our site!</p>
</body>

</html>
