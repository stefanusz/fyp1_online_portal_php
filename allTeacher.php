<?php
session_start();


// Check whether the user is logged in or not.
if (isset($_SESSION['email_add']) || isset($_COOKIE['email_add']))
{
    if (isset($_SESSION['email_add']))
    {
        $session = "You are log in as " . $_SESSION['first_name'] . "!<br/>";
        $profile = "<a href='chooseProfile.php'> Manage my profile </a><br/>";
        $dologout = "<a href='dologout.php'> Click here to Log out </a><br/>";

        if ($_SESSION['role'] == 'teacher')
        {
            $videoform = "<form id=videoform method=POST action=doVideo.php>
					
			<label for='inputtext1'>Youtube Video URL:</label>
			<input id=video type=text name=video  /><br/><br/>

                        
			<input id=submit type=submit name=submit value='Submit' />
			<input id=reset type=reset name=reset value='Clear Form' /><br/>	
					
				
			</form>";
            if ($_SESSION['role'] == 'teacher')
            {
                $teachernav = "<li><a href=video.php title=Your List of Videos. >Video</a></li>
                           <li><a href=myStudent.php title=Your List of Students. >My Students</a></li>";
            }

          
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
            $videoform = "<form id=videoform method=POST action=doVideo.php>
					
			<label for='inputtext1'>Youtube Video URL:</label>
			<input id=video type=text name=video  />
                        
                        
			<input id=inputsubmit1 type=submit name=submit value='Submit' />
			<input id=reset type=reset name=reset value='Clear Form' /><br/>	
					
				
			</form>";
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

include 'dbFunctions.php';

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
                        <h1>Showing the whole list of Teachers!</h1>



                        <div class="width75 floatLeft">

                            <p>

                                <?php
                                if ($_SESSION['email_add']  || $_COOKIE['email_add'])
                                {

                                    $tbl_name1 = "teacher";
                                    // How many adjacent pages should be shown on each side?
                                    $adjacents = 3;

                                    /*
                                      First get total number of rows in data table.
                                      If you have a WHERE clause in your query, make sure you mirror it here.
                                     */
                                    $query = "SELECT COUNT(*) as num FROM $tbl_name1 ";
                                    $total_pages = mysqli_fetch_array(mysqli_query($connect, $query));
                                    $total_pages = $total_pages[num];

                                    /* Setup vars for query. */
                                    $targetpage = "allTeacher.php";  //your file name  (the name of this file)
                                    $limit = 10;         //how many items to show per page
                                    $page = $_GET['page'];

                                    if ($page)
                                    {
                                        $start = ($page - 1) * $limit;    //first item to display on this page
                                    }
                                    else
                                    {
                                        $start = 0;        //if no page var is given, set start to 0
                                    }

                                    /* Get data. */
                                    $sql = "SELECT * FROM teacher  ORDER BY teacher_id DESC LIMIT $start, $limit";
                                    $result = mysqli_query($connect, $sql);

                                    /* Setup page vars for display. */


                                    if ($page == 0)
                                        $page = 1;     //if no page var is given, default to 1.
                                    $prev = $page - 1;       //previous page is page - 1
                                    $next = $page + 1;       //next page is page + 1
                                    $lastpage = ceil($total_pages / $limit);  //lastpage is = total pages / items per page, rounded up.
                                    $lpm1 = $lastpage - 1;      //last page minus 1

                                    /*
                                      Now we apply our rules and draw the pagination object.
                                      We're actually saving the code to a variable in case we want to draw it more than once.
                                     */
                                    $pagination = "";
                                    if ($lastpage > 1)
                                    {
                                        $pagination .= "<div class=\"pagination\">";
                                        //previous button
                                        if ($page > 1)
                                        {
                                            $pagination.= "<a href=\"$targetpage?page=$prev\">« previous</a>";
                                        }
                                        else
                                        {
                                            $pagination.= "<span class=\"disabled\">« previous</span>";
                                        }

                                        //pages	
                                        if ($lastpage < 7 + ($adjacents * 2)) //not enough pages to bother breaking it up
                                        {
                                            for ($counter = 1; $counter <= $lastpage; $counter++)
                                            {
                                                if ($counter == $page)
                                                    $pagination.= "<span class=\"current\">$counter</span>";
                                                else
                                                    $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
                                            }
                                        }
                                        elseif ($lastpage > 5 + ($adjacents * 2)) //enough pages to hide some
                                        {
                                            //close to beginning; only hide later pages
                                            if ($page < 1 + ($adjacents * 2))
                                            {
                                                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                                                {
                                                    if ($counter == $page)
                                                        $pagination.= "<span class=\"current&search=$search\">$counter</span>";
                                                    else
                                                        $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
                                                }
                                                $pagination.= "...";
                                                $pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
                                                $pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";
                                            }
                                            //in middle; hide some front and some back
                                            elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
                                            {
                                                $pagination.= "<a href=\"$targetpage?page=1\">1</a>";
                                                $pagination.= "<a href=\"$targetpage?page=2\">2</a>";
                                                $pagination.= "...";
                                                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                                                {
                                                    if ($counter == $page)
                                                        $pagination.= "<span class=\"current\">$counter</span>";
                                                    else
                                                        $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
                                                }
                                                $pagination.= "...";
                                                $pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
                                                $pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";
                                            }
                                            //close to end; only hide early pages
                                            else
                                            {
                                                $pagination.= "<a href=\"$targetpage?page=1\">1</a>";
                                                $pagination.= "<a href=\"$targetpage?page=2\">2</a>";
                                                $pagination.= "...";
                                                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
                                                {
                                                    if ($counter == $page)
                                                        $pagination.= "<span class=\"current\">$counter</span>";
                                                    else
                                                        $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
                                                }
                                            }
                                        }

                                        //next button
                                        if ($page < $counter - 1)
                                            $pagination.= "<a href=\"$targetpage?page=$next\">next »</a>";
                                        else
                                            $pagination.= "<span class=\"disabled\">next »</span>";
                                        $pagination.= "</div>\n";
                                    }


                                    echo "$pagination <br/>
            <br/>
            <input type=button value='Back to previous page!' onclick='history.back(-1)' /><br/><br/>";
                                    
                                    while ($runrows = mysqli_fetch_array($result))
                                    {
                                        $id = $runrows['teacher_id'];
                                        $t_fname = $runrows['first_name'];
                                        $t_lname = $runrows['last_name'];
                                        $rates = $runrows['rates'];
                                        $qualification = $runrows['qualification'];
                                        $experience = $runrows['experience'];


                                       echo  $result2 = "<table border=0 cellpadding=2 cellspacing=0>
                        
                                                   


                                                    <br/><b>First Name:</b> $t_fname 

                                                    <br/><b>Last Name:</b> $t_lname
                                                    <br/><b>Rates:</b> $rates
                                                    <br/><b>Qualification:</b> $qualification
                                                    <br/><b>Experience:</b> $experience

                                                    <br/><a href =details.php?id=$id  >More details</a>";

                                    if (($_SESSION['role'] == 'student') || ($_COOKIE['role'] == 'student'))
                                    {
                                       echo  $result3 = "<br/><a href =relation.php?id=$id >I want to be taught by this teacher! </a>
                                                    </table>";
                                    }
                                    else
                                    {
                                        echo $result3 = "</table>";
                                    }
                                    
                                    }
                                    echo $pagination;
                                    mysqli_close($connect);
                                }
                                else
                                {
                                $needmember = "Please Log-In, you need to be a member to view this!";
                                echo $needmember;
                                }
                                
                                ?>
                            </p>
                        </div>

                        <div class="width25 floatRight">
                            <p>

                            </p>
                        </div>
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