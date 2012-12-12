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
 if (isset($_POST['submit'])) {
  ?>
  <h2>Advanced Search: Result</h2>
  
  <?php } else { ?>
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
   
   <input type="submit" text="Search" />
   <input type="reset" text="Reset" />
  </form>

 </body>

</html>
