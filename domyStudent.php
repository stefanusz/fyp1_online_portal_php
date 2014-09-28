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
                        <h1>Managing your Students!</h1>
                        <p>
                            <?php
                            if ($_SESSION['role'] == 'teacher' || $_COOKIE['role'] == 'teacher')
                            {
                                $button = $_GET['submit'];
                                $search = $_GET['search'];

                                if (!$button)
                                {
                                    $nosubmit = "<h3>You try to by pass the system! Go back!!</h3>";
                                    echo $nosubmit;
                                }
                                else
                                {
                                    $searchword = "<h2>Listing all Students with status of: <u><i>$search</i></u></h2>";
                                    echo $searchword;
                                    include('dbFunctions.php');

                                    if ($_SESSION['email_add'])
                                    {
                                        $teacherEmail = $_SESSION['email_add'];
                                    }
                                    else
                                    {
                                        $teacherEmail = $_COOKIE['email_add'];
                                    }


                                    $teachersql = "SELECT teacher_id FROM teacher WHERE email_add = '$teacherEmail'";
                                    $runteachersql = mysqli_query($connect, $teachersql);
                                    while ($run = mysqli_fetch_array($runteachersql))
                                    {
                                        $teacherID = $run['teacher_id'];
                                    }

                                    $construct = "(SELECT ru.first_name, ru.last_name, ru.email_add, r.status, r.teacher_id, r.registeruser_id
FROM registereduser ru, relation r WHERE r.registeruser_id = ru.registeruser_id AND r.status = '$search' AND r.teacher_id = '$teacherID')";

                                    $run = mysqli_query($connect, $construct);
                                    $foundrows = mysqli_num_rows($run);
                                    if ($foundrows != '0')
                                    {
                                        while ($runrows = mysqli_fetch_array($run))
                                        {

                                            $first_name = $runrows['first_name'];
                                            $last_name = $runrows['last_name'];
                                            $email_add = $runrows['email_add'];
                                            $status = $runrows['status'];
                                           

                                            
                                                
                                                
                                                $result2 = "<table border='0' cellpadding='2' cellspacing='0'>
								<tr>
								
								<br/><b>Email Address:</b> $email_add 
								
								</tr>
								
								
								<br/><b>First Name:</b>$first_name
								
								
								
								<br/><b>Last Name:</b>$last_name 
                                                                
                                                                <br/><b>Status:</b>$status ";
                                                ?>
                                                <?php
                                                if ($status == 'pending')
                                                {
                                                    $edit = " <br/> <a href =doActive.php?email_add=$email_add >Accept Student Request to be taught.</a>
                                                            <br/> <a href =doDeactivate.php?email_add=$email_add >Reject Student Request to be taught.</a>
								
								</table>";
                                                }
                                                else if ($status == 'active')
                                                {
                                                    $edit = "<br/> <br/> <a href =doPending.php?email_add=$email_add >Make Student into Pending mode.</a>
								<br/> <a href =doDeactivate.php?email_add=$email_add >Close Student Tuition.</a>
								</table>";
                                                }
                                                else if ($status == 'inactive')
                                                {
                                                    $edit = "<br/><a href =doActive.php?email_add=$email_add >Accept Student Request to be taught.</a>
                                                        <br/><a href =doPending.php?email_add=$email_add >Make Student into Pending mode.</a>
								</table>";
                                                }
                                                ?>
                                                <?php
                                                echo "<table border=1 cellpadding=2 cellspacing=0>" . $result2 . "</table>";
                                                echo $edit;
                                            
                                        }

                                        mysqli_close($connect);
                                    }
                                    else
                                    {
                                        $noresult = "There is no student with this status found.";
                                        echo "<p>" . $noresult . "</p>";
                                    }
                                }
                            }
                            else
                            {
                                echo "You are not allowed to do this.";
                            }
                            ?>
                        </p>
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