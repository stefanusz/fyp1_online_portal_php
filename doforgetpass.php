<?php
session_start();

$submit = $_POST['submit'];

// check whether the user is already logged in or not.
if (isset($_SESSION['email_add']) || isset($_COOKIE['email_add']))
{
    if (isset($_SESSION['email_add']))
    {
        $session = "You are log in as " . $_SESSION['first_name'] . "!<br/>";
        $profile = "<a href='chooseProfile.php'> Manage my profile </a><br/>";
        $dologout = "<a href='dologout.php'> Click here to Log out </a><br/>";
        if ($_SESSION['role'] == 'teacher')
        {
            $teachernav = "<li><a href=video.php title=Your List of Videos. >Video</a></li>
                           <li><a href=myStudent.php title=Your List of Students. >My Students</a></li>";
        }

        if ($_SESSION['role'] == 'student')
        {
            $studentnav = "<li><a href=myTeacher.php title=List of My Teachers >My Teacher</a></li>";
        }
    }
    else
    {

        $cookie = "You are log in as " . $_COOKIE['first_name'] . "!<br/><br/>";
        $profile = "<a href='chooseProfile.php'> Manage my profile </a><br/><br/>";
        $dologout = "<a href='dologout.php'> Click here to Log out </a><br/><br/>";
        if ($_COOKIE['role'] == 'teacher')
        {
            $teachernav = "<li><a href=video.php title=Your List of Videos. >Video</a></li>
							<li><a href=myStudent.php title=Your List of Students. >My Students</a></li>";
        }

        if ($_COOKIE['role'] == 'student')
        {
            $studentnav = "<li><a href=myTeacher.php title=List of My Teachers >My Teacher</a></li>";
        }
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
					
			<p><a href='register.php'>Register here.</a></p>
			<p><a href='forgetpass.php'>Forget password.</a></p>		
					
				</form>";
}


// check if user is logged in, if yes, can't access; if not then the email will be sent.

if ($submit)
{
    if (isset($_SESSION['email_add']) || $_COOKIE['email_add'])
    {
        $login = "You are already logged in. There is no way you could have forget your password <br/><br/>
		If this is not you, please click here <a href='dologout.php'>Click here!</a>";
    }
    else
    {
        $email_add = $_POST['email_add'];
        
        
        if ($email_add)
        {
            $emailcheck = mysqli_query($connect, "(SELECT `email_add` FROM registereduser WHERE `email_add` ='$email_add') UNION (SELECT `email_add` FROM teacher WHERE email_add ='$email_add')UNION (SELECT `email_add` FROM portalmanager WHERE email_add ='$email_add')");
            $count = mysqli_num_rows($emailcheck);

            if ($count == 1)
            {
                include('dbFunctions.php');

                $randompass = createRandomPassword(); //generate random password for user and updating the database accordingly

                mysqli_query($connect, "UPDATE  `registereduser` SET `password` = SHA1('$randompass') WHERE email_add = '$email_add' ") or die(mysql_error());
                mysqli_query($connect, "UPDATE  `teacher` SET `password` = SHA1('$randompass') WHERE email_add = '$email_add' ") or die(mysql_error());
                mysqli_query($connect, "UPDATE  `portalmanager`  SET `password` = SHA1('$randompass') WHERE email_add = '$email_add' ") or die(mysql_error());


                //Getting the name of the user. 


                $sql = mysqli_query($connect, "(SELECT `first_name` FROM registereduser WHERE `email_add` ='$email_add') UNION (SELECT `first_name` FROM teacher WHERE email_add ='$email_add') UNION (SELECT `first_name` FROM portalmanager WHERE email_add ='$email_add')");



                while ($runrows = mysqli_fetch_array($sql))
                {

                    $first_name = $runrows['first_name'];
                }

                // generate email to notify user of new generate password
                $to = $email_add;
                $subject = "Reset of Password from Portal Manager.";

                $message = "
		<html>
		<head>
		<title>Reset of Password</title>
		</head>
		<body>
		<p>This email contains your new password!</p>
		<br/>
		<p>Hi $first_name!</p>
		<br/>
		<p>This is your new password $randompass.</p>
		<br/>
		<p>Please log in with this password and change your password. Thank you. <p>
		<br/>
		<br/>
		<br/>
		<p>Best regards,</p>
		<p>Portal Manager</p>
		<p>Management of Portal Learners</p>
		</body>
		</html>
		";

                // HTML headers
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

                // header
                $headers .= 'From: Portal Manager for the Learners.<91934@myrp.edu.sg>' . "\r\n";


                mail($to, $subject, $message, $headers);

                $forgetpass = "We have sent the new password to you. Please check your email. Thank you.";

                mysqli_close($connect);
            }
            else
            {
                $nouser = "You are not registered in our database! Please check your email again!";
            }
        }
        else
        {
            $noEmailentered = "<h3>You never enter anything!</h3>";
        }
    }
}
else
{
    $nosubmit = "You never click the submit button! Click <a href=changepass.php> here.</a>";
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
                    <li><a href="allTeacher.php" title="The whole list of our teachers." >List of all Teachers</a></li>
<?php
echo $teachernav;
echo $studentnav;
?>
                    <li><a href="search.php" title="Search the database!">Search</a></li>
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
echo "$form";
echo "$cookie";
echo "$session";
echo "$profile<br/>";
echo "$dologout<br/>";
?>

                        <a href="http://facebook.com/stefanusz" title="Join us at Facebook!"><img src="administrator/socialnetwork/facebook.png" width="67" height="72" alt="Facebook" longdesc="http://facebook.com/stefanusz" /></a> <a href="http://twitter.com/stefanusz" title="Join us at Twitter!"><img src="administrator/socialnetwork/3.png" width="67" height="72" alt="Twitter" longdesc="http://twitter.com/stefanusz" /></a> 

                    </p>
                </div>

                <!-- 75 percent width column, aligned to the right -->
                <div class="width75 floatRight"> 

                    <!-- Gives the gradient block -->
                    <div class="gradient"> <a name="fluidity"></a>
                        <h1>Forget of Password!</h1>
                        <br />
                        <br />
                        <p> 
<?php
echo $forgetpass;
echo $nouser;
echo $noEmailentered;
?> 
                        </p>
                    </div>
                    <div class="gradient"> <a name="coding"></a>
                        <h1>&nbsp;</h1>
                    </div>
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