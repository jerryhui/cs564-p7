<html>

 <head>
<title>Update users: CS 564-Instant Music Festival</title>
<link rel="stylesheet" type="text/css" href="instantFest.css" />
</head>
 

 <body>
 
 <h2>Sample CS 564 PHP Project: Update Page</h2>
  <?php include 'menu.php'; ?>
  <h3>Modify the Attributes of an Existing Book</h3>
  <p>
  Enter an exact Last Name first (so that we can locate the user).<br>
  Then enter values for the remaining attributes.<br> 
  We will set those attributes to the entered values.
  </p>
  <div class="searchform">
    <form name="form1" method="post" action="modify.php">
      <ul>
        <li>
	 <span>Last Name</span>
	 <input type="text" name="lastname">
	</li>
	<li>
	 <span>First Name</span>
	 <input type="text" name="firstname">
	</li>
	<li>
	 <span>Email Address</span>
	 <input type="text" name="email">
	</li>
        <li>
	 <span>About</span>
	 <textarea rows="3" cols="30" name="about"></textarea>
	</li>
	<li>
        <input type="submit" name="Submit" value="Submit"><input type="reset" name="Submit2" value="Reset">
        </li>
    </form>
  </div>


  <h3>Insert a new User</h3>
  <p>
  Please enter the First Name, Last Name, Email Address, and<br>
  About section for the user you would like to create.
  </p>

    <div class="searchform">
    <form name="form1" method="post" action="insert.php">
     <ul>
      <li>
        <span>About</span>
        <textarea rows="3" cols="30" name="about"></textarea>
      </li>
      <li>
        <span>First Name</span>
        <input type="text" name="firstname" />
      </li>
      <li>
        <span>Last Name</span>
        <input type="text" name="lastname" />
      </li>
      <li>
	<span>Email Address</span>
	<input type="text" name="email">
      </li>
      <li>
	<span>User type</span>
	<input type="radio" name="usertype" value="musician" />Musician&nbsp;<input 
type="radio" name="usertype" value="band" />Band
      </li>

      <li><input type="submit" name="Submit" value="Submit"><input type="reset" name="Submit2" value="Reset"></li>
     </ul>
    </form>
  </div>

  <h3>Delete an Existing User</h3>  
  <p>
  Please type the First and Last name of the person you wish to delete.  If you wish to delete a band,
  place the band name in the Last Name box and leave the first name area blank.
  </p>
  
  <div class="searchform">
    <form name="form1" method="post" action="delete.php">
     <ul>
        <li>
        <span>First Name</span>
        <input type="text" name="firstname">
        </li>
        <li>
	 <span>Last Name</span>
	 <input type="text" name="lastname">
        </li>
        <li><input type="submit" name="Submit" value="Submit"><input type="reset" name="Submit2" value="Reset">
        </li>
     </ul>
    </form>
  </div>
  
  </body>

</html>
