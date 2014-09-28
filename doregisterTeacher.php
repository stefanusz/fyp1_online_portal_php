<?php
session_start();

$submit = $_POST['submit'];


if ($submit)
{
    include ('dbFunctions.php');

    $email_add = strtolower(mysqli_real_escape_string($connect, strip_tags($_POST['email_add'])));
    $first_name = strtolower(mysqli_real_escape_string($connect, strip_tags($_POST['first_name'])));
    $last_name = strtolower(mysqli_real_escape_string($connect, strip_tags($_POST['last_name'])));
    $password = mysqli_real_escape_string($connect, strip_tags($_POST['password']));
    $password2 = mysqli_real_escape_string($connect, strip_tags($_POST['password2']));
    $image = $_FILES["uploadedfile"]["name"];
    $contact_no = mysqli_real_escape_string($connect, strip_tags($_POST['contact_no']));
    $ic_number = mysqli_real_escape_string($connect, strip_tags($_POST['ic_number']));
    $postal_code = mysqli_real_escape_string($connect, strip_tags($_POST['postal_code']));
    $rates = mysqli_real_escape_string($connect, strip_tags($_POST['rates']));
    $qualification = strtolower(mysqli_real_escape_string($connect, strip_tags($_POST['qualification'])));
    $experience = strtolower(mysqli_real_escape_string($connect, strip_tags($_POST['experience'])));
    $day = strip_tags($_POST['day']);
    $month = strip_tags($_POST['month']);
    $year = strip_tags($_POST['year']);

    //host statements for checkboxes and youtube url
    $video = mysqli_real_escape_string($connect, $_POST['video']);
    $pattern = "http://youtu.be/";
    $replacement = "";
    $videolink = str_replace($pattern, $replacement, $video);

    $music = $_POST['music'];
    $religion = $_POST['religion'];
    $cooking = $_POST['cooking'];
    $magic = $_POST['magic'];
    $dance = $_POST['dance'];
    $hairstylist = $_POST['hairstylist'];
    $lifestyle = $_POST['lifestyle'];
    $sports = $_POST['sports'];
    $education = $_POST['education'];
    $artncraft = $_POST['artncraft'];
    $massagetherapy = $_POST['massagetherapy'];



    $emailcheck = mysqli_query($connect, "(SELECT `email_add` FROM registereduser WHERE `email_add` ='$email_add') UNION (SELECT `email_add` FROM teacher WHERE email_add ='$email_add')UNION (SELECT `email_add` FROM portalmanager WHERE email_add ='$email_add')");

    $count = mysqli_num_rows($emailcheck);

    if ($email_add && $first_name)
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

                            if (file_exists("administrator/teacherimage/" . $_FILES["uploadedfile"]["name"]))
                            {
                                $imageexist = "The image already exist. Not possible to enter another one.<br/><br/>";
                                $imagename = $_FILES["uploadedfile"]["name"] . " already exists. <br/>
							<input type=button value='Go Back!' onclick='history.back(-1)' /><br/>";
                            }
                            else
                            {


                                mysqli_query($connect, "INSERT INTO `teacher` (`teacher_id`, `email_add`, `first_name`, `last_name`, `password`, `image`, `contact_no`, `ic_number`, `postal_code`, `rates`, `qualification`, `experience`, `join_date`, `updated`, `dob`, `role`, `status`)
	

		VALUES (NULL, '$email_add', '$first_name', '$last_name', SHA1('$password'), '$image', '$contact_no', '$ic_number', '$postal_code', '$rates', '$qualification', '$experience', CURRENT_TIMESTAMP, NULL, '$year-$month-$day', 'teacher', 'inactive')") or die(mysql_error());


                                move_uploaded_file($_FILES["uploadedfile"]["tmp_name"], "administrator/teacherimage/" . $_FILES["uploadedfile"]["name"]);

                                $sql = mysqli_query($connect, "SELECT `teacher_id` FROM teacher WHERE `email_add` = '$email_add' ");



                                while ($runrows = mysqli_fetch_array($sql))
                                {

                                    $teacher_id = $runrows['teacher_id'];
                                }



                                if ($music == 1)
                                {
                                    mysqli_query($connect, "INSERT INTO `resolvecategory` (`category_id`, `teacher_id`) VALUES ('$music','$teacher_id')");
                                }
                                if ($religion == 2)
                                {
                                    mysqli_query($connect, "INSERT INTO `resolvecategory` (`category_id`, `teacher_id`) VALUES ('$religion','$teacher_id')");
                                }
                                if ($cooking == 3)
                                {
                                    mysqli_query($connect, "INSERT INTO `resolvecategory` (`category_id`, `teacher_id`) VALUES ('$cooking','$teacher_id')");
                                }
                                if ($magic == 4)
                                {
                                    mysqli_query($connect, "INSERT INTO `resolvecategory` (`category_id`, `teacher_id`) VALUES ('$magic','$teacher_id')");
                                }
                                if ($dance == 5)
                                {
                                    mysqli_query($connect, "INSERT INTO `resolvecategory` (`category_id`, `teacher_id`) VALUES ('$dance','$teacher_id')");
                                }
                                if ($hairstylist == 6)
                                {
                                    mysqli_query($connect, "INSERT INTO `resolvecategory` (`category_id`, `teacher_id`) VALUES ('$hairstylist','$teacher_id')");
                                }
                                if ($lifestyle == 7)
                                {
                                    mysqli_query($connect, "INSERT INTO `resolvecategory` (`category_id`, `teacher_id`) VALUES ('$lifestyle','$teacher_id')");
                                }
                                if ($sports == 8)
                                {
                                    mysqli_query($connect, "INSERT INTO `resolvecategory` (`category_id`, `teacher_id`) VALUES ('$sports','$teacher_id')");
                                }
                                if ($education == 9)
                                {
                                    mysqli_query($connect, "INSERT INTO `resolvecategory` (`category_id`, `teacher_id`) VALUES ('$education','$teacher_id')");
                                }
                                if ($artncraft == 10)
                                {
                                    mysqli_query($connect, "INSERT INTO `resolvecategory` (`category_id`, `teacher_id`) VALUES ('$artncraft','$teacher_id')");
                                }
                                if ($massagetherapy == 11)
                                {
                                    mysqli_query($connect, "INSERT INTO `resolvecategory` (`category_id`, `teacher_id`) VALUES ('$massagetherapy','$teacher_id')");
                                }

                                if ($video)
                                {
                                    mysqli_query($connect, "INSERT INTO `videos` (`video_id`, `link`, `teacher_id`) VALUES (NULL, '$videolink', '$teacher_id')");
                                }



                                mysqli_close($connect);
                                $sucess = "You have Succesfully Registered!";
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
                    <?php
                    echo "$form";
                    echo "$cookie";
                    echo "$session";
                    echo "$profile<br/>";
                    echo "$dologout<br/>";
                    ?>

                    <a href="http://facebook.com/stefanusz" title="Join us at Facebook!"><img src="administrator/socialnetwork/facebook.png" width="67" height="72" alt="Facebook" longdesc="http://facebook.com/stefanusz" /></a> <a href="http://twitter.com/stefanusz" title="Join us at Twitter!"><img src="administrator/socialnetwork/3.png" width="67" height="72" alt="Twitter" longdesc="http://twitter.com/stefanusz" /></a> 

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