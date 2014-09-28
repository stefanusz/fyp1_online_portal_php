<?php
session_start();

// check whether the user is already logged in or not.
if(isset($_SESSION['email_add'])|| isset($_COOKIE['email_add']))
{
		if(isset($_SESSION['email_add']))
	{
		$session = "You are log in as " .$_SESSION['first_name']. "!<br/>";
		$profile = "<a href='profile.php'> Manage my profile </a><br/>";
		$dologout = "<a href='dologout.php'> Click here to Log out </a><br/>";
	
					
	}
	else
	{
					
		$cookie = "You are log in as " .$_COOKIE['first_name']. "!<br/><br/>";
		$profile = "<a href='profile.php'> Manage my profile </a><br/><br/>";
		$dologout = "<a href='dologout.php'> Click here to Log out </a><br/><br/>";
		
	}
				
}
else
{
	$form =  "<form id=form1 method=post action=dologin.php>
					
		<label for='inputtext1'>Email:</label>
		<input id='email_add' type=text name='email_add'  />
		<label for='inputtext2'>Password:</label>
		<input id='password' type='password' name='password'  /><br/><br/>	
		<input id='checkbox' name='checkbox' type=checkbox value='on' /> Remember Me<br/><br/>
		<input id=inputsubmit1 type=submit name=submit value='Sign In' /><br/>
					
		<p><a href='forgetpass.php'>Forget password.</a></p>		
					
	</form>";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en-AU">
<head>
<title>Portal for the Learners! :)</title>
<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />
<meta name="author" content="fullahead.org" />
<meta name="keywords" content="Open Web Design, OWD, Free Web Template, Lazy Days, Fullahead" />
<meta name="description" content="A free web template designed by Fullahead.org and hosted on OpenWebDesign.org" />
<meta name="robots" content="index, follow, noarchive" />
<meta name="googlebot" content="noarchive" />
<link rel="stylesheet" type="text/css" href="css/html.css" media="screen, projection, tv " />
<link rel="stylesheet" type="text/css" href="css/layout.css" media="screen, projection, tv" />
<link rel="stylesheet" type="text/css" href="css/print.css" media="print" />
<link rel="shortcut icon" href="favicon/favicon.ico" type="image/x-icon"/>
</head>

<body>

<!-- CONTENT: Holds all site content except for the footer.  This is what causes the footer to stick to the bottom -->
<div id="content"> </div>
<!-- HEADER: Holds title, subtitle and header images -->
<div id="header">
  <div id="title">
    <h1><a href="index.php" title="Home" class="here"><font color="#FFFFFF">Portal Learners</font></a></h1>
    <h2>in the city</h2>
  </div>
  <img src="images/bg/balloons.gif" alt="balloons" class="balloons" /> <img src="images/bg/header_left.jpg" alt="left slice" class="left" /> <img src="images/bg/header_right.jpg" alt="right slice" class="right" /> </div>

<!-- MAIN MENU: Top horizontal menu of the site.  Use class="here" to turn the current page tab on -->
<div id="mainMenu">
  <ul class="floatRight">
    <li><a href="index.php" title="Home" class="here">Home</a></li>
    <li><a href="manage.php" title="Manage the Users & Managers">Manage</a></li>
    <li><a href="contactus.php" title="Send us an email and talk to us!">Contact Us</a></li>
  </ul>
</div>

<!-- PAGE CONTENT BEGINS: This is where you would define the columns (number, width and alignment) -->
<div id="page"> 
  
  <!-- 25 percent width column, aligned to the left -->
  <div class="width25 floatLeft leftColumn">
    <h1>Login</h1>
    <p>
      <?php
	 
		echo "$cookie";
		echo "$session";
		echo "$profile<br/>";
		echo "$dologout<br/>";
		echo "$form";
		
	  ?>
      <a href="http://facebook.com/stefanusz" title="Join us at Facebook!"><img src="socialnetwork/facebook.png" width="67" height="72" alt="Facebook" longdesc="http://facebook.com/stefanusz" /></a> <a href="http://twitter.com/stefanusz" title="Join us at Twitter!"><img src="socialnetwork/3.png" width="67" height="72" alt="Twitter" longdesc="http://twitter.com/stefanusz" /></a> </p>
  </div>
  
  <!-- 75 percent width column, aligned to the right -->
  <div class="width75 floatRight"> 
    
    <!-- Gives the gradient block -->
    <div class="gradient"> <a name="fluidity"></a>
      <h2 class="title"><span>Delete Account</span></h2>
      <div class="story">
        <p>Please search which account you want to delete?</p>
        <form action="dodelete.php" method="get">
          <input type="text" size="20" name="search" />
          <br />
          <input name="submit" type="submit" value="Search" onclick="return validate_field(search,'Please enter a keyword')" />
        </form>
        <?php
// to show the search results
if(($_SESSION['role'] == 'admin'))
{
	$button = $_GET['submit'];
	$search = $_GET['search'];


echo "<br/><p>You search for this: <u><i>$search</i></u></p>";
		
	include('connection.php');

		// explode = split search keywords by spaces theen search individually with each of the keyword component
			$search_exploded = explode (" ", $search);
			// .= equals to APPEND (add to the previous letter
			// concat = joining 
			foreach($search_exploded as $search_each)
			{
				$x++;
				if ($x == 1)
					$construct .= "CONCAT(email_add) LIKE '%$search_each%'";
				else
					$construct .= "OR CONCAT(email_add) LIKE '%$search_each%'";
			
			
					}
					
					$construct = "SELECT * FROM teacher WHERE $construct";
					if ($search == "")
					{
						// empty line!!
					}
					else 
					{
						$run = mysqli_query($connect, $construct);
						$foundrows = mysqli_num_rows($run);
						
						if ($foundrows==0)
						
					{
						echo "<br/>";
						echo "<br/>";
						echo "<p>No result found!</p>";
						echo "<br/>";
						echo "<br/>";
						echo "<br/>";
						echo "<br/>";
						echo "<br/>";
						echo "<br/>";
						echo "<br/>";
						
						
						
								}
									
						else 
						{
							echo "<p>$foundrows results found!</p>";
							
							while ($runrows = mysqli_fetch_array($run))
							{
								$id = $runrows['id'];
								$email_add = $runrows['email_add'];
								//$description = $runrows['description'];
								//$location = $runrows['location'];
								//$image = $runrows['image'];
								
								echo 	"<br/>";
								echo	 "	<br/><table border=0 cellpadding=2 cellspacing=0>
								
											<tr>
											<th width='70'>ID No:</th>" 	. "<td id=text1>" . $id 	.		"</td>
											</tr>
											
											<tr>
											<th width='70'>Email:</th>" 	. "<td id=text1>" . $email_add 	.		"</td>
											</tr>
											
											<tr>
											<th width='70'><b>Name:</b></th>" 	. "<td id=text1>". $name .	"</td>
											</tr>
											
											<tr>
											<th width='70'><b>Location:</b></th>" 	. "<td id=text1>". $location .		"</td>
											</tr>
											
											<tr>
											<th width='70'><b>Image:</b></th>" 	. "<td id=text1>". $image .		"</td>
											</tr>
											
											
							
									</table><br/>";	
							}
							
						}
					}
			
	mysqli_close($connect);
}
else
{
	echo "You need an admin right to do this!";
}

?>
        <br />
        <br />
        <br />
        <!-- to input which one the user want to delete-->
        <p>Please enter the ID number that you wish to delete.</p>
        <form action="dodelete2.php" method="get">
          <input type="text" size="20" name ="deleteId" id="" />
          <input name="submitcat" type="submit" value="Delete" onclick="return confirmSubmit()" />
        </form>
        <br />
        <br />
      </div>
      <div class="gradient"> </div>
    </div>
  </div>
</div>

<!-- FOOTER: Site footer for links, copyright, etc. -->
<div id="footer">
  <div id="width"> Copyright Stefanus. <span class="floatRight"> <a href="index.php" title="Introduction">intro</a> <span class="grey">|</span> <a href="help.html" title="Learn how to use the template">help</a> <span class="grey">|</span> <a href="tags.html" title="View the styled tags">tags</a> <span class="grey">|</span> <a href="print.html" title="View the print layout">print</a> <span class="grey">|</span> <a href="http://fullahead.org/contact.html" title="Get in touch">mail</a> <span class="grey">|</span> 
    <!--This theme is free for distriubtion,  so long as  link to openwebdesing.org and florida-villa.com  stay on the theme--> 
    Courtesy <a href="http://www.openwebdesign.org" target="_blank">Open Web Design</a><a href="http://www.dubaiapartments.biz" target="_blank"><img src="spacer.gif" width="5" height="5" border="0"/></a>Thanks to <a href="http://www.florida-villa.com" target="_blank">Florida Vacation Homes</a> </span> </div>
</div>
</body>
</html>