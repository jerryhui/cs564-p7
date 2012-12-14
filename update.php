<html>

 <head>
<title>Update users: CS 564-Instant Music Festival</title>
<link rel="stylesheet" type="text/css" href="instantFest.css" />
</head>
 

 <body>
 
 <h2>Sample CS 564 PHP Project: Update Page</h2>
  <?php include 'menu.php'; ?>
  <h3>Modify the Attributes of an Existing Book</h3>

Enter an exact title first (so that we can locate the book).<br>
Then enter values for the remaining attributes.<br> 
We will set those attributes to the entered values.
  <table width="40%" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
    <form name="form1" method="post" action="modify.php">
      <tr align="center">
        <td height="30" class="deepred" width="48%"><font face="Times New Roman, Times, serif">Last Name</font></td>
        <td height="30" class="deepred" width="52%"><input type="text" name="lastname"></td>
	</tr>
	<tr align="center">
	<td height="30" class="deepred" width="48%"><font face="Times New Roman, Times, serif">First Name</font></td>
        <td height="30" class="deepred" width="52%"><input type="text" name="firstname"></td>
	</tr>
	<tr align="center">
	<td height="30" class="deepred" width="48%"><font face="Times New Roman, Times, serif">Email Address</font></td>
        <td height="30" class="deepred" width="52%"><input type="text" name="email">
        <tr align="center">
	<td height="30" class="deepred" width="48%"><font face="Times New roman, Times, serif">About</font></td>
	<td height="30" class="deepred" width="52%"><textarea rows="3" cols="30" name="about"></textarea></td>
      </tr>
      <tr>
        <td height="24" align="center" width="48%">
        </td>
        <td align="center" width="52%"><input type="submit" name="Submit" value="Submit"><input type="reset" name="Submit2" value="Reset">
        </td>
      </tr>
    </form>
  </table>


  <h3>Insert a new User</h3>

  Please enter the First Name, Last Name, Email Address, and<br>
  About section for the user you would like to create.<br>

    <table width="40%" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
    <form name="form1" method="post" action="insert.php">
      <tr align="center">
        <td height="30" class="deepred" width="48%"><font face="Times New Roman, Times, serif">About</font></td>
        <td height="50" class="deepred" width="52%"><textarea rows="3" cols="30" name="about"></textarea></td>
      </tr>
      <tr align="center">
        <td height="30" class="deepred" width="48%"><font face="Times New Roman, Times, serif">First Name</font></td>
        <td height="30" class="deepred" width="52%"><input type="text" name="firstname"></td>
      </tr>
      <tr align="center">
        <td height="30" class="deepred" width="48%"><font face="Times New Roman, Times, serif">Last Name</font></td>
        <td height="30" class="deepred" width="52%"><input type="text" name="lastname"></td>
      </tr>
      <tr align="center">
	<td height="30" class="deepred" width "48%"><font face="Times New Roman, Times, serif">Email Address</font></td>
	<td height="30" class="deepred" width "52%"><input type="text" name="email"></td>
      </tr>

        <td height="24" align="center" width="48%">
        </td>
        <td align="center" width="52%"><input type="submit" name="Submit" value="Submit"><input type="reset" name="Submit2" value="Reset">
<input type="hidden" name="usertype" value="musician" />
        </td>
      </tr>
    </form>
  </table>

  <h3>Delete an Existing User</h3>  

  Please type the First and Last name of the person <br>
  you wish to delete.  If you wish to delete a band, <br>
  place the band name in the Last Name box and leave<br>
  the first name area blank.<br>
  
      <table width="40%" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
    <form name="form1" method="post" action="delete.php">
        <tr align="center">
        <td height="30" class="deepred" width="48%"><font face="Times New Roman, Times, serif">First Name</font></td>
        <td height="30" class="deepred" width="52%"><input type="text" name="firstname"></td>
        </tr>     </tr>
        <tr align="center">
        <td height="30" class="deepred" width="48%"><font face="Times New Roman, Times, serif">Last Name</font></td>
        <td height="30" class="deepred" width="52%"><input type="text" name="lastname">
        </td>
      </tr>

        <td height="24" align="center" width="48%">
        </td>
        <td align="center" width="52%"><input type="submit" name="Submit" value="Submit"><input type="reset" name="Submit2" value="Reset">
        </td>
      </tr>
    </form>
  </table>
  
  </body>

</html>
