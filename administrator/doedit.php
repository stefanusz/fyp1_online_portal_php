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
    }
    else
    {

        $cookie = "You are log in as " . $_COOKIE['first_name'] . "!<br/><br/>";
        $profile = "<a href='chooseProfile.php'> Manage my profile </a><br/><br/>";
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
        <script src="javascript.js" type="text/javascript"></script>
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
                    <li><a href="manage.php" title="Manager the Users & Managers">Manage</a></li>
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
                        <a href="http://facebook.com/stefanusz" title="Join us at Facebook!"><img src="socialnetwork/facebook.png" width="67" height="72" alt="Facebook" longdesc="http://facebook.com/stefanusz" /></a> <a href="http://twitter.com/stefanusz" title="Join us at Twitter!"><img src="socialnetwork/3.png" width="67" height="72" alt="Twitter" longdesc="http://twitter.com/stefanusz" /></a> </p>
                </div>

                <!-- 75 percent width column, aligned to the right -->
                <div class="width75 floatRight"> 

                    <!-- Gives the gradient block -->
                    <div class="gradient"> <a name="fluidity"></a>
                        <h1>Welcome to Administrator Site!</h1>
                        <p>
                            <?php
                            if ($_SESSION['role'] == 'admin' || $_COOKIE['role'] == 'admin')
                            {
                                $button = $_GET['submit'];
                                $search = $_GET['search'];
                                
                                $backbutton = "<input type=button value='Back to previous page!' onclick='history.back(-1)' />";

                                if (!$button)
                                {
                                    $nosubmit = "<h3>You try to by pass the system! Hahaha! Go back!!</h3>";
                                    echo $nosubmit;
                                }
                                else
                                {
                                    $searchword = "<h2>Listing all users with status of: <u><i>$search</i></u></h2>";
                                    echo $searchword;
                                    include('dbFunctions.php');

                                    $construct = "(SELECT first_name, last_name, email_add, status, role FROM registereduser WHERE status = '$search' ) UNION (SELECT first_name, last_name, email_add, status, role FROM teacher WHERE status = '$search')";
                                    $run = mysqli_query($connect, $construct);
                                    $foundrows = mysqli_num_rows($run);

                                    $tbl_name1 = "teacher";
                                    $tbl_name2 = "registereduser";  //your table name
                                    // How many adjacent pages should be shown on each side?
                                    $adjacents = 3;

                                    /*
                                      First get total number of rows in data table.
                                      If you have a WHERE clause in your query, make sure you mirror it here.
                                     */
                                    $query = "(SELECT COUNT(*) as num FROM $tbl_name1 WHERE status = '$search') ";
                                    $query2 = "(SELECT COUNT(*) as num1 FROM $tbl_name2 WHERE status = '$search')";
                                    $total_pages0 = mysqli_fetch_array(mysqli_query($connect, $query));
                                    $total_pages1 = mysqli_fetch_array(mysqli_query($connect, $query2));
                                    $total_pages = ($total_pages0[num] + $total_pages1[num1]);

                                    /* Setup vars for query. */
                                    $targetpage = "doedit.php";  //your file name  (the name of this file)
                                    $limit = 10;         //how many items to show per page
                                    $page = $_GET['page'];

                                    if ($page)
                                        $start = ($page - 1) * $limit;    //first item to display on this page
                                    else
                                        $start = 0;        //if no page var is given, set start to 0

                                    /* Get data. */
                                    $sql = "(SELECT first_name, last_name, email_add, status, role FROM $tbl_name1  WHERE status = '$search') UNION (SELECT first_name, last_name, email_add, status, role FROM $tbl_name2  WHERE status = '$search') LIMIT $start, $limit";
                                    $result = mysqli_query($connect, $sql);

                                    /* Setup page vars for display. */

                                    /* JAY CHECK */
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
                                            $pagination.= "<a href=\"$targetpage?page=$prev&search=$search&submit=$button\">« previous</a>";
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
                                                    $pagination.= "<a href=\"$targetpage?page=$counter&search=$search&submit=$button\">$counter</a>";
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
                                                        $pagination.= "<span class=\"current&search=$search&submit=$button\">$counter</span>";
                                                    else
                                                        $pagination.= "<a href=\"$targetpage?page=$counter&search=$search&submit=$button\">$counter</a>";
                                                }
                                                $pagination.= "...";
                                                $pagination.= "<a href=\"$targetpage?page=$lpm1&search=$search&submit=$button\">$lpm1</a>";
                                                $pagination.= "<a href=\"$targetpage?page=$lastpage&search=$search&submit=$button\">$lastpage</a>";
                                            }
                                            //in middle; hide some front and some back
                                            elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
                                            {
                                                $pagination.= "<a href=\"$targetpage?page=1&search=$search&submit=$button\">1</a>";
                                                $pagination.= "<a href=\"$targetpage?page=2&search=$search&submit=$button\">2</a>";
                                                $pagination.= "...";
                                                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                                                {
                                                    if ($counter == $page)
                                                        $pagination.= "<span class=\"current\">$counter&search=$search&submit=$button</span>";
                                                    else
                                                        $pagination.= "<a href=\"$targetpage?page=$counter&search=$search&submit=$button\">$counter</a>";
                                                }
                                                $pagination.= "...";
                                                $pagination.= "<a href=\"$targetpage?page=$lpm1&search=$search&submit=$button\">$lpm1</a>";
                                                $pagination.= "<a href=\"$targetpage?page=$lastpage&search=$search&submit=$button\">$lastpage</a>";
                                            }
                                            //close to end; only hide early pages
                                            else
                                            {
                                                $pagination.= "<a href=\"$targetpage?page=1&search=$search&submit=$button\">1</a>";
                                                $pagination.= "<a href=\"$targetpage?page=2&search=$search&submit=$button\">2</a>";
                                                $pagination.= "...";
                                                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
                                                {
                                                    if ($counter == $page)
                                                        $pagination.= "<span class=\"current\">$counter&search=$search&submit=$button</span>";
                                                    else
                                                        $pagination.= "<a href=\"$targetpage?page=$counter&search=$search&submit=$button\">$counter</a>";
                                                }
                                            }
                                        }

                                        //next button
                                        if ($page < $counter - 1)
                                            $pagination.= "<a href=\"$targetpage?page=$next&search=$search&submit=$button\">next »</a>";
                                        else
                                            $pagination.= "<span class=\"disabled\">next »</span>";
                                        $pagination.= "</div>\n";
                                    }
                                    if ($foundrows == 0)
                                    {

                                        $norows = "No result found!<br/><br/>
				<input type=button value='Go Back!' onclick='history.back(-1)' />";

                                        echo $norows;
                                    }
                                    else
                                    {
                                        $haverows = "$foundrows results found!";
                                        echo $haverows;
                                        
                                        echo '<br/><br/>'.$backbutton;
                                        echo $pagination;
                                        while ($runrows = mysqli_fetch_array($result))
                                        {

                                            $first_name = $runrows['first_name'];
                                            $last_name = $runrows['last_name'];
                                            $email_add = $runrows['email_add'];
                                            $status = $runrows['status'];
                                            $role = $runrows['role'];


                                            $result2 = "<table border='0' cellpadding='2' cellspacing='0'>
								<tr>
								
								<br/><b>Email Address:</b> $email_add 
								
								</tr>
								
								
								<br/><b>First Name:</b>$first_name
								
								
								
								<br/><b>Last Name:</b>$last_name 
								
								
								
								<br/><b>Role:</b>$role 
								
								
								
								<br/><b>Status:</b> $status";
                                            ?>
                                            <?php
                                            if (($status == 'active') && ($role == 'teacher'))
                                            {
                                                $edit = "<br/> <a href =details.php?email_add=$email_add >More details.</a>
								<br/> <a href =doBan.php?email_add=$email_add >Ban User.</a>
								<br/> <a href =doDeactivate.php?email_add=$email_add >Deactivate User.</a>
								<br/> <a href =dodelete.php?email_add=$email_add onclick='return confirmDelete()' >Delete User.</a>
								</table>";
                                            }
                                            else if (($status == 'inactive') && ($role == 'teacher'))
                                            {
                                                $edit = "<br/> <a href =details.php?email_add=$email_add >More details.</a>
								<br/> <a href =doActivate.php?email_add=$email_add >Activate User.</a>
								<br/> <a href =doBan.php?email_add=$email_add >Ban User.</a>
								<br/> <a href =dodelete.php?email_add=$email_add onclick='return confirmDelete()' >Delete User.</a>
								</table>";
                                            }
                                            else if (($status == 'banned') && ($role == 'teacher'))
                                            {
                                                $edit = "<br/> <a href =details.php?email_add=$email_add >More details.</a>	
								<br/> <a href =doActivate.php?email_add=$email_add >Activate User.</a>
								<br/> <a href =doDeactivate.php?email_add=$email_add >Deactivate User.</a>
								<br/> <a href =dodelete.php?email_add=$email_add onclick='return confirmDelete()' >Delete User.</a>
								</table>";
                                            }

                                            if (($status == 'active') && ($role == 'student'))
                                            {
                                                $edit = "<br/> <a href =details.php?email_add=$email_add >More details.</a>
								<br/> <a href =doBan.php?email_add=$email_add >Ban User.</a>
								<br/> <a href =doDeactivate.php?email_add=$email_add >Deactivate User.</a>
								
								</table>";
                                            }
                                            else if (($status == 'inactive') && ($role == 'student'))
                                            {
                                                $edit = "<br/> <a href =details.php?email_add=$email_add >More details.</a>
								<br/> <a href =doActivate.php?email_add=$email_add >Activate User.</a>
								<br/> <a href =doBan.php?email_add=$email_add >Ban User.</a>
								
								</table>";
                                            }
                                            else if (($status == 'banned') && ($role == 'student'))
                                            {
                                                $edit = "<br/> <a href =details.php?email_add=$email_add >More details.</a>	
								<br/> <a href =doActivate.php?email_add=$email_add >Activate User.</a>
								<br/> <a href =doDeactivate.php?email_add=$email_add >Deactivate User.</a>
								
								</table>";
                                            }
                                            ?>
                                            <?php
                                            echo "<table border=1 cellpadding=2 cellspacing=0>" . $result2 . "</table>";
                                            echo $edit;
                                           
                                        }
                                        echo '<br/><br/>'.$backbutton;
                                        echo $pagination;
                                        mysqli_close($connect);
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