<?php
session_start();

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


// Do update to the database.

$submit = $_POST['submit'];


if ($_SESSION['role'] == 'teacher' || $_COOKIE['role'] == 'teacher')
{

    if ($submit)
    {
        include ('dbFunctions.php');

        $email_add = $_SESSION['email_add'];
        $email_add2 = $_COOKIE['email_add'];

        $first_name = strtolower(mysqli_real_escape_string($connect, strip_tags($_POST['first_name'])));
        $last_name = strtolower(mysqli_real_escape_string($connect, strip_tags($_POST['last_name'])));
        $contact_no = mysqli_real_escape_string($connect, strip_tags($_POST['contact_no']));
        $ic_number = mysqli_real_escape_string($connect, strip_tags($_POST['ic_number']));
        $postal_code = mysqli_real_escape_string($connect, strip_tags($_POST['postal_code']));
        $rates = mysqli_real_escape_string($connect, strip_tags($_POST['rates']));
        $qualification = mysqli_real_escape_string($connect, strip_tags($_POST['qualification']));
        $experience = mysqli_real_escape_string($connect, strip_tags($_POST['experience']));
        $day = strip_tags($_POST['day']);
        $month = strip_tags($_POST['month']);
        $year = strip_tags($_POST['year']);



        if (isset($_SESSION['email_add']))
        {
            mysqli_query($connect, "UPDATE  `teacher`  SET `first_name` = '$first_name', `last_name` = '$last_name', `contact_no`='$contact_no', `rates`='$rates', `qualification` = '$qualification',`experience` = '$experience' WHERE email_add = '$email_add' ") or die(mysql_error());
        }
        else if ($_COOKIE['email_add'])
        {
            mysqli_query($connect, "UPDATE  `teacher`  SET `first_name` = '$first_name', `last_name` = '$last_name', `contact_no`='$contact_no', `rates`='$rates', `qualification` = '$qualification',`experience` = '$experience' WHERE email_add = '$email_add2' ") or die(mysql_error());
        }


        if ($day == '1' && $month == '1' && $year == '2011')
        {
            
        }
        else
        {
            mysqli_query($connect, "UPDATE  `teacher`  SET  `dob` = '$year-$month-$day'") or die(mysql_error());
        }

        $sucess = "You have succesfully updated your account. <br/>
					Please re-login for the change to take effect... <br/><br/>
					";
    }
    else
    {
        $nosubmit = "You never click the submit button! ";
    }
}


if ($_SESSION['role'] == 'student' || $_COOKIE['role'] == 'student')
{
    if ($submit)
    {
        include ('dbFunctions.php');

        $email_add = $_SESSION['email_add'];
        $email_add2 = $_COOKIE['email_add'];

        $first_name = strtolower(mysqli_real_escape_string($connect, strip_tags($_POST['first_name'])));
        $last_name = strtolower(mysqli_real_escape_string($connect, strip_tags($_POST['last_name'])));
        $description = mysqli_real_escape_string($connect, strip_tags($_POST['description']));
        $race = mysqli_real_escape_string($connect, strip_tags($_POST['race']));
        $contact_no = mysqli_real_escape_string($connect, strip_tags($_POST['contact_no']));
        $ic_number = mysqli_real_escape_string($connect, strip_tags($_POST['ic_number']));
        $postal_code = mysqli_real_escape_string($connect, strip_tags($_POST['postal_code']));


        $nationality = mysqli_real_escape_string($connect, strip_tags($_POST['nationality']));
        $day = strip_tags($_POST['day']);
        $month = strip_tags($_POST['month']);
        $year = strip_tags($_POST['year']);

        if (isset($_SESSION['email_add']))
        {
            mysqli_query($connect, "UPDATE  `registereduser`  SET `ic_number` = '$ic_number',`first_name` = '$first_name', `last_name` = '$last_name', `description` = '$description', `race` = '$race',`contact_no`='$contact_no', `nationality` = '$nationality' WHERE email_add = '$email_add' ") or die(mysql_error());
        }
        else if ($_COOKIE['email_add'])
        {
            mysqli_query($connect, "UPDATE  `registereduser`  SET `ic_number` = '$ic_number',`first_name` = '$first_name', `last_name` = '$last_name', `description` = '$description', `race` = '$race',`contact_no`='$contact_no', `nationality` = '$nationality' WHERE email_add = '$email_add2' ") or die(mysql_error());
        }

        if ($day == '1' && $month == '1' && $year == '2011')
        {
            
        }
        else
        {
            mysqli_query($connect, "UPDATE  `registereduser`  SET  `dob` = '$year-$month-$day'") or die(mysql_error());
        }



        $sucess = "You have succesfully updated your account. <br/>
					Please re-login for the change to take effect... <br/><br/>
					";
    }
    else
    {
        $nosubmit = "You never click the submit button! ";
    }
}

if ($_SESSION['role'] == 'admin' || $_COOKIE['role'] == 'admin')
{
    if ($submit)
    {
        include ('dbFunctions.php');

        $email_add = $_SESSION['email_add'];
        $email_add2 = $_COOKIE['email_add'];
        $first_name = strtolower(mysqli_real_escape_string($connect, strip_tags($_POST['first_name'])));
        $last_name = strtolower(mysqli_real_escape_string($connect, strip_tags($_POST['last_name'])));
        $description = mysqli_real_escape_string($connect, strip_tags($_POST['description']));
        $postal_code = mysqli_real_escape_string($connect, strip_tags($_POST['postal_code']));
        $ic_number = mysqli_real_escape_string($connect, strip_tags($_POST['ic_number']));
        $day = strip_tags($_POST['day']);
        $month = strip_tags($_POST['month']);
        $year = strip_tags($_POST['year']);





        if (isset($_SESSION['email_add']))
        {
            mysqli_query($connect, "UPDATE  `portalmanager`  SET `first_name` = '$first_name', `last_name` = '$last_name', `description` = '$description', `postal_code` = '$postal_code', `ic_number` = '$ic_number' WHERE email_add = '$email_add' ") or die(mysql_error());
        }
        else if ($_COOKIE['email_add'])
        {
            mysqli_query($connect, "UPDATE  `portalmanager`  SET `first_name` = '$first_name', `last_name` = '$last_name', `description` = '$description', `postal_code` = '$postal_code', `ic_number` = '$ic_number' WHERE email_add = '$email_add2' ") or die(mysql_error());
        }

        if ($day == '1' && $month == '1' && $year == '2011')
        {
            
        }
        else
        {
            mysqli_query($connect, "UPDATE  `portalmanager`  SET  `dob` = '$year-$month-$day'") or die(mysql_error());
        }


        $sucess = "You have succesfully updated your account. <br/>
					Please re-login for the change to take effect... <br/><br/>
					";
    }
    else
    {
        $nosubmit = "You never click the submit button! ";
    }
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
                        <a href="http://facebook.com/stefanusz" title="Join us at Facebook!"><img src="administrator/socialnetwork/facebook.png" width="67" height="72" alt="Facebook" longdesc="http://facebook.com/stefanusz" /></a> <a href="http://twitter.com/stefanusz" title="Join us at Twitter!"><img src="administrator/socialnetwork/3.png" width="67" height="72" alt="Twitter" longdesc="http://twitter.com/stefanusz" /></a> </p>
                </div>

                <!-- 75 percent width column, aligned to the right -->
                <div class="width75 floatRight"> 

                    <!-- Gives the gradient block -->
                    <div class="gradient"> <a name="fluidity"></a>
                        <h1>Latest Highlights!</h1>
                        <h2>&nbsp;</h2>
                        <p><?php echo $sucess; ?></p>
                    </div>
                    <div class="gradient"> <a name="coding"></a> </div>
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