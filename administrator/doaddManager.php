<?php
session_start();

$submit = $_POST['submit'];


if ($submit)
{
    include ('dbFunctions.php');

    $email_add = strtolower(mysqli_real_escape_string($connect, strip_tags($_POST['email_add'])));
    $first_name = strtolower(mysqli_real_escape_string($connect, strip_tags($_POST['first_name'])));
    $last_name = strtolower(mysqli_real_escape_string($connect, strip_tags($_POST['last_name'])));
    $password = strtolower(mysqli_real_escape_string($connect, strip_tags($_POST['password'])));
    $password2 = strtolower(mysqli_real_escape_string($connect, strip_tags($_POST['password2'])));
    $image = $_FILES["uploadedfile"]["name"];
    $ic_number = strtolower(mysqli_real_escape_string($connect, strip_tags($_POST['ic_number'])));
    $postal_code = strtolower(mysqli_real_escape_string($connect, strip_tags($_POST['postal_code'])));
    $day = strip_tags($_POST['day']);
    $month = strip_tags($_POST['month']);
    $year = strip_tags($_POST['year']);

    $emailcheck = mysqli_query($connect, "(SELECT `email_add` FROM registereduser WHERE `email_add` ='$email_add') UNION (SELECT `email_add` FROM teacher WHERE email_add ='$email_add') UNION (SELECT `email_add` FROM portalmanager WHERE email_add ='$email_add')");


    $count = mysqli_num_rows($emailcheck);

    if ($email_add && $first_name && $last_name && $password && $password2 && $ic_number && $postal_code)
    {
        if ($count != 0)
        {
            $emailexist = "Email already exist. Please fill in again<br/><br/>";
            $backbutton = "<input type=button value='Go Back!' onclick='history.back(-1)' />";
        }
        else
        {
            if ($password == $password2)
            {

                if (strlen($password) < 6 || strlen($password) > 25)
                {
                    $passwrong = "<p>The password you have entered is either too long or too short</p>
									  <p>Please enter password between 6 to 25 characters. Thank you.</p>
									  <p><input type=button value='Go Back!' onclick='history.back(-1)' /></p>";
                }
                else
                {

                    if ((($_FILES["uploadedfile"]["type"] == "image/gif")
                            || ($_FILES["uploadedfile"]["type"] == "image/jpeg")
                            || ($_FILES["uploadedfile"]["type"] == "image/png")
                            || ($_FILES["uploadedfile"]["type"] == "image/pjpeg")
                            || ($_FILES["uploadedfile"]["type"] == "image/jpg"))
                            && ($_FILES["uploadedfile"]["size"] < 50000000))
                    {

                        if ($_FILES["file"]["error"] > 0)
                        {
                            $errorimage = "Return Code: " . $_FILES["uploadedfile"]["error"] . "<br />";
                        }
                        else
                        {

                            if (file_exists("portalmanagerimage/" . $_FILES["uploadedfile"]["name"]))
                            {
                                $imageexist = "The image already exist. Not possible to enter another one.<br/><br/>";
                                $imagename = $_FILES["uploadedfile"]["name"] . " already exists. <br/>
									<input type=button value='Go Back!' onclick='history.back(-1)' /><br/>";
                            }
                            else
                            {

                                mysqli_query($connect, "INSERT INTO `portalmanager` (`portalmanager_id`, `email_add`, `first_name`, `last_name`, `password`, `image`, `description`, `ic_number`, `postal_code`, `join_date`, `updated`, `role`,`dob` )
	

										VALUES (NULL, '$email_add', '$first_name', '$last_name', SHA1('$password'), '$image',  '$description', '$ic_number', '$postal_code', CURRENT_TIMESTAMP, NULL, 'admin','$year-$month-$day' )") or die(mysql_error());


                                move_uploaded_file($_FILES["uploadedfile"]["tmp_name"], "portalmanagerimage/" . $_FILES["uploadedfile"]["name"]);


                                mysqli_close($connect);
                                $sucess = "You have Succesfully Registering a Portal Manager!";
                            }
                        }
                    }
                    else
                    {
                        $fileupload = "Invalid file";
                    }
                }
            }
            else
            {
                $passwordmsg = "The password you have entered does not match<br/>
					<input type=button value='Go Back!' onclick='history.back(-1)' /><br/>";
            }
        }
    }
    else
    {
        $completefields = "Please fill in all the fields!<br/><br/>
								<input type=button value='Go Back!' onclick='history.back(-1)' />";
    }
}
else
{
    $message = "You never click the submit button! Click <a href='register.php'>here</a> to go back.";
}



// check whether the user is already logged in or not.
if (isset($_SESSION['email_add']) || isset($_COOKIE['email_add']))
{
    if (isset($_SESSION['email_add']))
    {
        $session = "You are log in as " . $_SESSION['first_name'] . "!<br/>";
        $profile = "<a href='profile.php'> Manage my profile </a><br/>";
        $dologout = "<a href='dologout.php'> Click here to Log out </a><br/>";
    }
    else
    {

        $cookie = "You are log in as " . $_COOKIE['first_name'] . "!<br/><br/>";
        $profile = "<a href='profile.php'> Manage my profile </a><br/><br/>";
        $dologout = "<a href='dologout.php'> Click here to Log out </a><br/><br/>";
    }
}
else
{
    $form = "<form id=form1 method=post action=dologin.php>
					
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
        <div id="content"> 

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
<?php
echo "$cookie";
echo "$session";
echo "$profile<br/>";
echo "$dologout<br/>";
echo "$form";
?>
                    <a href="http://facebook.com/stefanusz" title="Join us at Facebook!"><img src="socialnetwork/facebook.png" width="67" height="72" alt="Facebook" longdesc="http://facebook.com/stefanusz" /></a> <a href="http://twitter.com/stefanusz" title="Join us at Twitter!"><img src="socialnetwork/3.png" width="67" height="72" alt="Twitter" longdesc="http://twitter.com/stefanusz" /></a>
                    </p>
                </div>

                <!-- 75 percent width column, aligned to the right -->
                <div class="width75 floatRight"> 

                    <!-- Gives the gradient block -->
                    <div class="gradient"> <a name="fluidity"></a>
                        <h1>Registering as a Teacher.</h1>
                        <p> <?php echo $emailexist; ?> <?php echo $backbutton; ?> <?php echo $message; ?> <?php echo $passwrong; ?> <?php echo $passwordmsg; ?> <?php echo $fileupload; ?> <?php echo $sucess; ?> <?php echo $imageexist; ?> <?php echo $imagename; ?> <?php echo $errorimage; ?> <?php echo $completefields; ?> </p>
                        <p> Regards, <br />
                            Portal Manager. </p>
                    </div>
                    <div class="gradient"> </div>
                </div>
            </div>
        </div>

        <!-- FOOTER: Site footer for links, copyright, etc. -->
        <div id="footer">
            <div id="width"> Copyright Stefanus. <span class="floatRight"> <a href="index.php" title="Introduction">intro</a> </span> <span class="grey">|</span> <a href="help.html" title="Learn how to use the template">help</a> <span class="grey">|</span> <a href="tags.html" title="View the styled tags">tags</a> <span class="grey">|</span> <a href="print.html" title="View the print layout">print</a> <span class="grey">|</span> <a href="http://fullahead.org/contact.html" title="Get in touch">mail</a> <span class="grey">|</span> 
                <!--This theme is free for distriubtion,  so long as  link to openwebdesing.org and florida-villa.com  stay on the theme--> 
                Courtesy <a href="http://www.openwebdesign.org" target="_blank">Open Web Design</a> <a href="http://www.dubaiapartments.biz" target="_blank"> <img src="spacer.gif" width="5" height="5" border="0"/></a> Thanks to <a href="http://www.florida-villa.com" target="_blank">Florida Vacation Homes</a> </div>
        </div>
    </body>
</html>