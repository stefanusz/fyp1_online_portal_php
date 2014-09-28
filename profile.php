<?php
session_start();


// check whether the user is already logged in or not.
if (isset($_SESSION['email_add']) || isset($_COOKIE['email_add']))
{

    if ($_SESSION['role'] == 'teacher')
        {
            $teachernav = "<li><a href=video.php title=Your List of Videos. >Video</a></li>
                           <li><a href=myStudent.php title=Your List of Students. >My Students</a></li>";
            $uploadpicture = "<a href='picture.php'>Manage your picture.</a></br/>";
        }

        if ($_SESSION['role'] == 'student')
        {
            $studentnav = "<li><a href=myTeacher.php title=List of My Teachers >My Teacher</a></li>";
        }
        
        if ($_COOKIE['role'] == 'teacher')
        {
            $teachernav = "<li><a href=video.php title=Your List of Videos. >Video</a></li>
							<li><a href=myStudent.php title=Your List of Students. >My Students</a></li>";
            
            $uploadpicture = "<a href='picture.php'>Manage your picture.</a></br/>";
        }

        if ($_COOKIE['role'] == 'student')
        {
            $studentnav = "<li><a href=myTeacher.php title=List of My Teachers >My Teacher</a></li>";
        }
        
    include ('dbFunctions.php');

    if (isset($_SESSION['email_add']))
    {
        $session = "You are log in as " . $_SESSION['first_name'] . "!<br/>";
        $profile = "<a href='chooseProfile.php'> Manage my profile </a><br/>";
        $dologout = "<a href='dologout.php'> Click here to Log out </a><br/>";

        

        if ($_SESSION['role'] == 'teacher')
        {
            $email_add = $_SESSION['email_add'];

            $sql = "SELECT * FROM teacher WHERE email_add = '$email_add'";
            $run = mysqli_query($connect, $sql);
            while ($runrows = mysqli_fetch_array($run))
            {
                $first_name = $runrows['first_name'];
                $last_name = $runrows['last_name'];
                $rates = $runrows ['rates'];
                $qualification = $runrows ['qualification'];
                $experience = $runrows ['experience'];
                $ic_number = $runrows['ic_number'];
                $race = $runrows['race'];
                $contact_no = $runrows['contact_no'];
                $postal_code = $runrows['postal_code'];
                $nationality = $runrows['nationality'];
                $dob = $runrows['dob'];
            }

            $profileform = "<form enctype=multipart/form-data action=doProfile.php method=POST name=doProfile>
          
          
				<table width=473 border=0 cellpadding=10 cellspacing=2>
		  
		  
				

				<tr>
				<td width=70 height=57><font size=2.5>First Name:</font></td>
				<td width=275><input type=text name =first_name id=first_name value = $first_name /></td>
				</tr>
			
				<tr>
				<td width=70 height=57><font size=2.5>Last Name:</font></td>
				<td><input type=text name= last_name id=last_name value = $last_name /></td>
				</tr>
			
				
			
				<tr>
				<td width=70 height=57><font  size=2.5>Contact No:</font></td>
				<td><input tpye=text name =contact_no id=contact_no value = $contact_no /></td>
				</tr>
			
				<tr>
				<td width=70 height=57><font size=2.5>IC Number:</font></td>
				<td><input tpye=text name =ic_number id=ic_number value = $ic_number /></td>
				</tr>
			
				<tr>
				<td width=70 height=57><font size=2.5>postal_code:</font></td>
				<td><input tpye=text name =postal_code id=postal_code value = $postal_code /></td>
				</tr>
			
				<tr>
				<td width=70 height=57><font size=2.5>Rates:</font></td>
				<td><input tpye=text name =rates id=rates  value = $rates /></td>
				</tr>
			
				<tr>
				 <td width=70 height=57><font size=2.5>Qualification:</font></td>
				 <td><textarea name=qualification cols=45 rows=10 id=qualification> $qualification </textarea></td>
				</tr>
			
				<tr>
				<td width=70 height=57><font size=2.5>Experience:</font></td>
				<td><textarea name=experience cols=45 rows=10 id=experience> $experience </textarea></td>
				</tr>
			
                                <tr>
				<td width=70 height=57><font size=2.5>You current DOB:</font></td>
				<td width=70 height=57>$dob</td>
				</tr>
                                
				<tr>
				<td width=70 height=57><font  size=2.5> Date Of Birth:</font></td>
				<td>
					<select name = 'day'>
							<option value='1'>  1  </option>
							<option value='2'>  2  </option>
							<option value='3'>  3  </option>
							<option value='4'>  4  </option>
							<option value='5'>  5  </option>
							<option value='6'>  6  </option>
							<option value='7'>  6  </option>
							<option value='8'>  8  </option>
							<option value='9'>  9  </option>
							<option value='10'> 10 </option>
							<option value='11'> 11 </option>
							<option value='12'> 12 </option>
							<option value='13'> 13 </option>
							<option value='14'> 14 </option>
							<option value='15'> 15 </option>
							<option value='16'> 16 </option>
							<option value='17'> 17 </option>
							<option value='18'> 18 </option>
							<option value='19'> 19 </option>
							<option value='20'> 20 </option>
							<option value='21'> 21 </option>
							<option value='22'> 22 </option>
							<option value='23'> 23 </option>
							<option value='24'> 24 </option>
							<option value='25'> 25 </option>
							<option value='26'> 26 </option>
							<option value='27'> 27 </option>
							<option value='28'> 28 </option>
							<option value='29'> 29 </option>
							<option value='30'> 30 </option>
							<option value='31'> 31 </option>
					</select>
				
				
					<select name = 'month'>
							<option value='1'>  January   </option>
							<option value='2'>  February  </option>
							<option value='3'>  March     </option>
							<option value='4'>  April     </option>
							<option value='5'>  May       </option>
							<option value='6'>  June      </option>
							<option value='7'>  July      </option>
							<option value='8'>  August    </option>
							<option value='9'>  September </option>
							<option value='10'> October   </option>
							<option value='11'> November  </option>
							<option value='12'> December  </option>
					</select>
					
					<select name = 'year'>
							<option value='2011'> 2011 </option>
							<option value='2010'> 2010 </option>
							<option value='2009'> 2009 </option>
							<option value='2008'> 2008 </option>
							<option value='2007'> 2007 </option>
							<option value='2006'> 2006 </option>
							<option value='2005'> 2005 </option>
							<option value='2004'> 2004 </option>
							<option value='2003'> 2003 </option>
							<option value='2002'> 2002 </option>
							<option value='2001'> 2001 </option>
							<option value='2000'> 2000 </option>
							<option value='1999'> 1999 </option>
							<option value='1998'> 1998 </option>
							<option value='1997'> 1997 </option>
							<option value='1996'> 1996 </option>
							<option value='1995'> 1995 </option>
							<option value='1994'> 1994 </option>
							<option value='1993'> 1993 </option>
							<option value='1992'> 1992 </option>
							<option value='1991'> 1991 </option>
							<option value='1990'> 1990 </option>
							<option value='1989'> 1989 </option>
							<option value='1988'> 1988 </option>
							<option value='1987'> 1987 </option>
							<option value='1986'> 1986 </option>
							<option value='1985'> 1985 </option>
							<option value='1984'> 1984 </option>
							<option value='1983'> 1983 </option>
							<option value='1982'> 1982 </option>
							<option value='1981'> 1981 </option>
							<option value='1980'> 1980 </option>
							<option value='1979'> 1979 </option>
							<option value='1978'> 1978 </option>
							<option value='1977'> 1977 </option>
							<option value='1976'> 1976 </option>
							<option value='1975'> 1975 </option>
							<option value='1974'> 1974 </option>
							<option value='1973'> 1973 </option>
							<option value='1972'> 1972 </option>
							<option value='1971'> 1971 </option>
							<option value='1970'> 1970 </option							
					</select>
					</td>
					</tr>
				
				</tr>
            
				</table>
          
				<br />
				<input name=submit value=submit type=submit />
				<input name=reset value=reset type=reset />
				</form>";
        }
        if ($_SESSION['role'] == 'student')
        {

            $email_add = $_SESSION['email_add'];

            $sql = "SELECT * FROM registereduser WHERE email_add = '$email_add'";
            $run = mysqli_query($connect, $sql);
            while ($runrows = mysqli_fetch_array($run))
            {
                $first_name = $runrows['first_name'];
                $last_name = $runrows['last_name'];
                $description = $runrows['description'];
                $ic_number = $runrows['ic_number'];
                $race = $runrows['race'];
                $contact_no = $runrows['contact_no'];
                $postal_code = $runrows['postal_code'];
                $nationality = $runrows['nationality'];
                $dob = $runrows['dob'];
            }
            $profileform = "<form enctype=multipart/form-data action=doProfile.php method=POST name=doProfile>
          
          
				<table width=473 border=0 cellpadding=10 cellspacing=2>
		  
				

				<tr>
				<td width=70 height=57><font size=2.5>First Name:</font></td>
				<td width=275><input type=text name =first_name id=first_name value =  $first_name /></td>
				</tr>
			
				<tr>
				<td width=70 height=57><font size=2.5>Last Name:</font></td>
				<td><input type=text name= last_name id=last_name value = $last_name /></td>
				</tr>
			
			
				<tr>
				<td width=70 height=57><font  size=2.5>Description of Yourself:</font></td>
				<td><input tpye=text name =description id=description value = $description /></td>
				</tr>
			
				
			
				<tr>
				<td width=70 height=57><font size=2.5>Race:</font></td>
				<td width=275><input type=text name =race id=race value = $race /></td>
				</tr>
			
				<tr>
				<td width=70 height=57><font size=2.5>Contact No:</font></td>
				<td><input tpye=text name =contact_no id=contact_no value = $contact_no  /></td>
				</tr>
                        
                                <tr>
				<td width=70 height=57><font size=2.5>IC Number:</font></td>
				<td><input tpye=text name =ic_number id=ic_number value = $ic_number  /></td>
				</tr>
			
				<tr>
				<td width=70 height=57><font size=2.5>Nationality:</font></td>
				<td><input tpye=text name =nationality id=nationality value = $nationality /></td>
				</tr>
                                
                                <tr>
				<td width=70 height=57><font size=2.5>You current DOB:</font></td>
				<td width=70 height=57>$dob</td>
				</tr>
			
				<tr>
				<td width=70 height=57><font  size=2.5> Date Of Birth:</font></td>
				<td>
					<select name = 'day'>
							<option value='1'>  1  </option>
							<option value='2'>  2  </option>
							<option value='3'>  3  </option>
							<option value='4'>  4  </option>
							<option value='5'>  5  </option>
							<option value='6'>  6  </option>
							<option value='7'>  6  </option>
							<option value='8'>  8  </option>
							<option value='9'>  9  </option>
							<option value='10'> 10 </option>
							<option value='11'> 11 </option>
							<option value='12'> 12 </option>
							<option value='13'> 13 </option>
							<option value='14'> 14 </option>
							<option value='15'> 15 </option>
							<option value='16'> 16 </option>
							<option value='17'> 17 </option>
							<option value='18'> 18 </option>
							<option value='19'> 19 </option>
							<option value='20'> 20 </option>
							<option value='21'> 21 </option>
							<option value='22'> 22 </option>
							<option value='23'> 23 </option>
							<option value='24'> 24 </option>
							<option value='25'> 25 </option>
							<option value='26'> 26 </option>
							<option value='27'> 27 </option>
							<option value='28'> 28 </option>
							<option value='29'> 29 </option>
							<option value='30'> 30 </option>
							<option value='31'> 31 </option>
					</select>
				
				
					<select name = 'month'>
							<option value='1'>  January   </option>
							<option value='2'>  February  </option>
							<option value='3'>  March     </option>
							<option value='4'>  April     </option>
							<option value='5'>  May       </option>
							<option value='6'>  June      </option>
							<option value='7'>  July      </option>
							<option value='8'>  August    </option>
							<option value='9'>  September </option>
							<option value='10'> October   </option>
							<option value='11'> November  </option>
							<option value='12'> December  </option>
					</select>
					
					<select name = 'year'>
							<option value='2011'> 2011 </option>
							<option value='2010'> 2010 </option>
							<option value='2009'> 2009 </option>
							<option value='2008'> 2008 </option>
							<option value='2007'> 2007 </option>
							<option value='2006'> 2006 </option>
							<option value='2005'> 2005 </option>
							<option value='2004'> 2004 </option>
							<option value='2003'> 2003 </option>
							<option value='2002'> 2002 </option>
							<option value='2001'> 2001 </option>
							<option value='2000'> 2000 </option>
							<option value='1999'> 1999 </option>
							<option value='1998'> 1998 </option>
							<option value='1997'> 1997 </option>
							<option value='1996'> 1996 </option>
							<option value='1995'> 1995 </option>
							<option value='1994'> 1994 </option>
							<option value='1993'> 1993 </option>
							<option value='1992'> 1992 </option>
							<option value='1991'> 1991 </option>
							<option value='1990'> 1990 </option>
							<option value='1989'> 1989 </option>
							<option value='1988'> 1988 </option>
							<option value='1987'> 1987 </option>
							<option value='1986'> 1986 </option>
							<option value='1985'> 1985 </option>
							<option value='1984'> 1984 </option>
							<option value='1983'> 1983 </option>
							<option value='1982'> 1982 </option>
							<option value='1981'> 1981 </option>
							<option value='1980'> 1980 </option>
							<option value='1979'> 1979 </option>
							<option value='1978'> 1978 </option>
							<option value='1977'> 1977 </option>
							<option value='1976'> 1976 </option>
							<option value='1975'> 1975 </option>
							<option value='1974'> 1974 </option>
							<option value='1973'> 1973 </option>
							<option value='1972'> 1972 </option>
							<option value='1971'> 1971 </option>
							<option value='1970'> 1970 </option							
					</select>
					</td>
					</tr>
				
					</tr>
            
					</table>
          
					<br />
					<input name=submit value=submit type=submit />
					<input name=reset value=reset type=reset />
					</form>";
        }

        if ($_SESSION['role'] == 'admin')
        {
            $email_add = $_SESSION['email_add'];

            $sql = "SELECT * FROM portalmanager WHERE email_add = '$email_add'";
            $run = mysqli_query($connect, $sql);
            while ($runrows = mysqli_fetch_array($run))
            {
                $first_name = $runrows['first_name'];
                $last_name = $runrows['last_name'];
                $description = $runrows['description'];
                $ic_number = $runrows['ic_number'];
                $postal_code = $runrows['postal_code'];
                $dob = $runrows['dob'];
            }




            $profileform = "<form enctype=multipart/form-data action=doProfile.php method=POST name=doProfile>
          
          
				<table width=473 border=0 cellpadding=10 cellspacing=2>
		  
				

				<tr>
				<td width=70 height=57><font size=2.5>First Name:</font></td>
				<td width=275><input type=text name =first_name id=first_name value= $first_name /></td>
				</tr>
			
				<tr>
				<td width=70 height=57><font size=2.5>Last Name:</font></td>
				<td><input type=text name= last_name id=last_name value = $last_name /></td>
				</tr>
			
			
				<tr>
				<td width=70 height=57><font  size=2.5>Description:</font></td>
				<td><textarea name = description id = description >$description </textarea></td>
				</tr>
			
			
				<tr>
				<td width=70 height=57><font size=2.5>IC Number:</font></td>
				<td width=275><input type=text name =ic_number id=ic_number value = $ic_number /></td>
				</tr>
			
				<tr>
				<td width=70 height=57><font size=2.5>Postal Code:</font></td>
				<td><input tpye=text name = postal_code id=postal_code value = $postal_code /></td>
				</tr>

                                <tr>
				<td width=70 height=57><font size=2.5>You current DOB:</font> </td>
				<td width=70 height=57>$dob</td>
				</tr>
			
				<tr>
				<td width=70 height=57><font  size=2.5> Date Of Birth*:</font></td>
				<td>
					<select name = 'day'>
							<option value='1'>  1  </option>
							<option value='2'>  2  </option>
							<option value='3'>  3  </option>
							<option value='4'>  4  </option>
							<option value='5'>  5  </option>
							<option value='6'>  6  </option>
							<option value='7'>  6  </option>
							<option value='8'>  8  </option>
							<option value='9'>  9  </option>
							<option value='10'> 10 </option>
							<option value='11'> 11 </option>
							<option value='12'> 12 </option>
							<option value='13'> 13 </option>
							<option value='14'> 14 </option>
							<option value='15'> 15 </option>
							<option value='16'> 16 </option>
							<option value='17'> 17 </option>
							<option value='18'> 18 </option>
							<option value='19'> 19 </option>
							<option value='20'> 20 </option>
							<option value='21'> 21 </option>
							<option value='22'> 22 </option>
							<option value='23'> 23 </option>
							<option value='24'> 24 </option>
							<option value='25'> 25 </option>
							<option value='26'> 26 </option>
							<option value='27'> 27 </option>
							<option value='28'> 28 </option>
							<option value='29'> 29 </option>
							<option value='30'> 30 </option>
							<option value='31'> 31 </option>
					</select>
				
				
					<select name = 'month'>
							<option value='1'>  January   </option>
							<option value='2'>  February  </option>
							<option value='3'>  March     </option>
							<option value='4'>  April     </option>
							<option value='5'>  May       </option>
							<option value='6'>  June      </option>
							<option value='7'>  July      </option>
							<option value='8'>  August    </option>
							<option value='9'>  September </option>
							<option value='10'> October   </option>
							<option value='11'> November  </option>
							<option value='12'> December  </option>
					</select>
					
					<select name = 'year'>
							
							<option value='2010'> 2010 </option>
							<option value='2009'> 2009 </option>
							<option value='2008'> 2008 </option>
							<option value='2007'> 2007 </option>
							<option value='2006'> 2006 </option>
							<option value='2005'> 2005 </option>
							<option value='2004'> 2004 </option>
							<option value='2003'> 2003 </option>
							<option value='2002'> 2002 </option>
							<option value='2001'> 2001 </option>
							<option value='2000'> 2000 </option>
							<option value='1999'> 1999 </option>
							<option value='1998'> 1998 </option>
							<option value='1997'> 1997 </option>
							<option value='1996'> 1996 </option>
							<option value='1995'> 1995 </option>
							<option value='1994'> 1994 </option>
							<option value='1993'> 1993 </option>
							<option value='1992'> 1992 </option>
							<option value='1991'> 1991 </option>
							<option value='1990'> 1990 </option>
							<option value='1989'> 1989 </option>
							<option value='1988'> 1988 </option>
							<option value='1987'> 1987 </option>
							<option value='1986'> 1986 </option>
							<option value='1985'> 1985 </option>
							<option value='1984'> 1984 </option>
							<option value='1983'> 1983 </option>
							<option value='1982'> 1982 </option>
							<option value='1981'> 1981 </option>
							<option value='1980'> 1980 </option>
							<option value='1979'> 1979 </option>
							<option value='1978'> 1978 </option>
							<option value='1977'> 1977 </option>
							<option value='1976'> 1976 </option>
							<option value='1975'> 1975 </option>
							<option value='1974'> 1974 </option>
							<option value='1973'> 1973 </option>
							<option value='1972'> 1972 </option>
							<option value='1971'> 1971 </option>
							<option value='1970'> 1970 </option							
					</select>
					</td>
					</tr>
				
					</tr>
            
					</table>
          
					<br />
					<input name=submit value=submit type=submit />
					<input name=reset value=reset type=reset />
					</form>";
        }
    }
    else
    {

        $cookie = "You are log in as " . $_COOKIE['first_name'] . "!<br/><br/>";
        $profile = "<a href='chooseProfile.php'> Manage my profile </a><br/><br/>";
        $dologout = "<a href='dologout.php'> Click here to Log out </a><br/><br/>";

        $email_add = $_COOKIE['email_add'];


        if ($_COOKIE['role'] == 'teacher')
        {



            $sql = "SELECT * FROM teacher WHERE email_add = '$email_add'";
            $run = mysqli_query($connect, $sql);
            while ($runrows = mysqli_fetch_array($run))
            {
                $first_name = $runrows['first_name'];
                $last_name = $runrows['last_name'];
                $contact_no = $runrows['contact_no'];
                $ic_number = $runrows['ic_number'];
                $postal_code = $runrows['postal_code'];
                $rates = $runrows['rates'];
                $qualification = $runrows['qualification'];
                $experience = $runrows['experience'];
                $dob = $runrows['dob'];
            }
            $profileform = "<form enctype=multipart/form-data action=doProfile.php method=POST name=doProfile>
          
          
					<table width=473 border=0 cellpadding=10 cellspacing=2>
		  
					
	
					<tr>
					<td width=70 height=57><font size=2.5>First Name:</font></td>
					<td width=275><input type=text name =first_name id=first_name value = $first_name /></td>
					</tr>
			
					<tr>
					<td width=70 height=57><font size=2.5>Last Name:</font></td>
					<td><input type=text name= last_name id=last_name value = $last_name /></td>
					</tr>
			
					
			
					<tr>
					<td width=70 height=57><font  size=2.5>Contact No:</font></td>
					<td><input tpye=text name =contact_no id=contact_no value = $contact_no /></td>
					</tr>
			
					<tr>
					<td width=70 height=57><font size=2.5>IC Number:</font></td>
					<td><input tpye=text name =ic_number id=ic_number value = $ic_number /></td>
					</tr>
			
					<tr>
					<td width=70 height=57><font size=2.5>postal_code:</font></td>
					<td><input tpye=text name =postal_code id=postal_code value = $postal_code /></td>
					</tr>
			
					<tr>
					<td width=70 height=57><font size=2.5>Rates:</font></td>
					<td><input tpye=text name =rates id=rates value = $rates /></td>
					</tr>
			
					<tr>
					<td width=70 height=57><font size=2.5>Qualification:</font></td>
					<td><textarea name=qualification cols=45 rows=10 id=qualification> $qualification </textarea></td>
					</tr>
			
					<tr>
					<td width=70 height=57><font size=2.5>Experience:</font></td>
					<td><textarea name=experience cols=45 rows=10 id=experience > $experience </textarea></td>
					</tr>
                        
                                        <tr>
				<td width=70 height=57><font size=2.5>You current DOB:</font></td>
				<td width=70 height=57>$dob</td>
				</tr>
			
					<tr>
					<td width=70 height=57><font  size=2.5> Date Of Birth:</font></td>
					<td>
						<select name = 'day'>
							<option value='1'>  1  </option>
							<option value='2'>  2  </option>
							<option value='3'>  3  </option>
							<option value='4'>  4  </option>
							<option value='5'>  5  </option>
							<option value='6'>  6  </option>
							<option value='7'>  6  </option>
							<option value='8'>  8  </option>
							<option value='9'>  9  </option>
							<option value='10'> 10 </option>
							<option value='11'> 11 </option>
							<option value='12'> 12 </option>
							<option value='13'> 13 </option>
							<option value='14'> 14 </option>
							<option value='15'> 15 </option>
							<option value='16'> 16 </option>
							<option value='17'> 17 </option>
							<option value='18'> 18 </option>
							<option value='19'> 19 </option>
							<option value='20'> 20 </option>
							<option value='21'> 21 </option>
							<option value='22'> 22 </option>
							<option value='23'> 23 </option>
							<option value='24'> 24 </option>
							<option value='25'> 25 </option>
							<option value='26'> 26 </option>
							<option value='27'> 27 </option>
							<option value='28'> 28 </option>
							<option value='29'> 29 </option>
							<option value='30'> 30 </option>
							<option value='31'> 31 </option>
						</select>
				
				
						<select name = 'month'>
							<option value='1'>  January   </option>
							<option value='2'>  February  </option>
							<option value='3'>  March     </option>
							<option value='4'>  April     </option>
							<option value='5'>  May       </option>
							<option value='6'>  June      </option>
							<option value='7'>  July      </option>
							<option value='8'>  August    </option>
							<option value='9'>  September </option>
							<option value='10'> October   </option>
							<option value='11'> November  </option>
							<option value='12'> December  </option>
						</select>
					
						<select name = 'year'>
							<option value='2011'> 2011 </option>
							<option value='2010'> 2010 </option>
							<option value='2009'> 2009 </option>
							<option value='2008'> 2008 </option>
							<option value='2007'> 2007 </option>
							<option value='2006'> 2006 </option>
							<option value='2005'> 2005 </option>
							<option value='2004'> 2004 </option>
							<option value='2003'> 2003 </option>
							<option value='2002'> 2002 </option>
							<option value='2001'> 2001 </option>
							<option value='2000'> 2000 </option>
							<option value='1999'> 1999 </option>
							<option value='1998'> 1998 </option>
							<option value='1997'> 1997 </option>
							<option value='1996'> 1996 </option>
							<option value='1995'> 1995 </option>
							<option value='1994'> 1994 </option>
							<option value='1993'> 1993 </option>
							<option value='1992'> 1992 </option>
							<option value='1991'> 1991 </option>
							<option value='1990'> 1990 </option>
							<option value='1989'> 1989 </option>
							<option value='1988'> 1988 </option>
							<option value='1987'> 1987 </option>
							<option value='1986'> 1986 </option>
							<option value='1985'> 1985 </option>
							<option value='1984'> 1984 </option>
							<option value='1983'> 1983 </option>
							<option value='1982'> 1982 </option>
							<option value='1981'> 1981 </option>
							<option value='1980'> 1980 </option>
							<option value='1979'> 1979 </option>
							<option value='1978'> 1978 </option>
							<option value='1977'> 1977 </option>
							<option value='1976'> 1976 </option>
							<option value='1975'> 1975 </option>
							<option value='1974'> 1974 </option>
							<option value='1973'> 1973 </option>
							<option value='1972'> 1972 </option>
							<option value='1971'> 1971 </option>
							<option value='1970'> 1970 </option							
						</select>
						</td>
						</tr>
				
						</tr>
            
						</table>
          
						<br />
						<input name=submit value=submit type=submit />
						<input name=reset value=reset type=reset />
						</form>";
        }
        if ($_COOKIE['role'] == 'student')
        {


            $sql = "SELECT * FROM teacher WHERE email_add = '$email_add'";
            $run = mysqli_query($connect, $sql);
            while ($runrows = mysqli_fetch_array($run))
            {
                $first_name = $runrows['first_name'];
                $last_name = $runrows['last_name'];
                $description = $runrows['description'];
                $race = $runrows['race'];
                $contact_no = $runrows['contact_no'];
                $ic_number = $runrows['ic_number'];
                $postal_code = $runrows['postal_code'];
                $nationality = $runrows['nationality'];
                $dob = $runrows['dob'];
            }
            $profileform = "<form enctype=multipart/form-data action=doProfile.php method=POST name=doProfile>
          
          
					<table width=473 border=0 cellpadding=10 cellspacing=2>
		  
					

					<tr>
					<td width=70 height=57><font size=2.5>First Name:</font></td>
					<td width=275><input type=text name =first_name id=first_name value = $first_name /></td>
					</tr>
			
					<tr>
					<td width=70 height=57><font size=2.5>Last Name:</font></td>
					<td><input type=text name= last_name id=last_name value = $last_name /></td>
					</tr>
			
			
					
			
					<tr>
					<td width=70 height=57><font size=2.5>Description of Yourself:</font></td>
					<td width=275><textarea name=description cols=45 rows=10 id=description> $description </textarea></td>
					</tr>
			
					<tr>
					<td width=70 height=57><font size=2.5>Race:</font></td>
					<td width=275><input type=text name =race id=race value = $race /></td>
					</tr>
                        
                                        <tr>
					<td width=70 height=57><font  size=2.5>Contact No:</font></td>
					<td><input tpye=text name =contact_no id=contact_no value = $contact_no /></td>
					</tr>
			
					<tr>
					<td width=70 height=57><font size=2.5>IC Number:</font></td>
					<td><input tpye=text name =ic_number id=ic_number value = $ic_number /></td>
					</tr>
			
					
			
					<tr>
					<td width=70 height=57><font size=2.5>Postal Code:</font></td>
					<td><input tpye=text name =postal_code id=postal_code value = $postal_code /></td>
					</tr>
                        
                                        <tr>
					<td width=70 height=57><font size=2.5>Nationality:</font></td>
					<td><input tpye=text name =nationality id=nationality value = $nationality /></td>
					</tr>

                                        <tr>
				<td width=70 height=57><font size=2.5>You current DOB:</font> </td>
				<td width=70 height=57>$dob</td>
				</tr>
			
					<tr>
					<td width=70 height=57><font  size=2.5> Date Of Birth:*</font></td>
					<td>
						<select name = 'day'>
							<option value='1'>  1  </option>
							<option value='2'>  2  </option>
							<option value='3'>  3  </option>
							<option value='4'>  4  </option>
							<option value='5'>  5  </option>
							<option value='6'>  6  </option>
							<option value='7'>  6  </option>
							<option value='8'>  8  </option>
							<option value='9'>  9  </option>
							<option value='10'> 10 </option>
							<option value='11'> 11 </option>
							<option value='12'> 12 </option>
							<option value='13'> 13 </option>
							<option value='14'> 14 </option>
							<option value='15'> 15 </option>
							<option value='16'> 16 </option>
							<option value='17'> 17 </option>
							<option value='18'> 18 </option>
							<option value='19'> 19 </option>
							<option value='20'> 20 </option>
							<option value='21'> 21 </option>
							<option value='22'> 22 </option>
							<option value='23'> 23 </option>
							<option value='24'> 24 </option>
							<option value='25'> 25 </option>
							<option value='26'> 26 </option>
							<option value='27'> 27 </option>
							<option value='28'> 28 </option>
							<option value='29'> 29 </option>
							<option value='30'> 30 </option>
							<option value='31'> 31 </option>
						</select>
				
				
						<select name = 'month'>
							<option value='1'>  January   </option>
							<option value='2'>  February  </option>
							<option value='3'>  March     </option>
							<option value='4'>  April     </option>
							<option value='5'>  May       </option>
							<option value='6'>  June      </option>
							<option value='7'>  July      </option>
							<option value='8'>  August    </option>
							<option value='9'>  September </option>
							<option value='10'> October   </option>
							<option value='11'> November  </option>
							<option value='12'> December  </option>
						</select>
					
						<select name = 'year'>
							<option value='2011'> 2011 </option>
							<option value='2010'> 2010 </option>
							<option value='2009'> 2009 </option>
							<option value='2008'> 2008 </option>
							<option value='2007'> 2007 </option>
							<option value='2006'> 2006 </option>
							<option value='2005'> 2005 </option>
							<option value='2004'> 2004 </option>
							<option value='2003'> 2003 </option>
							<option value='2002'> 2002 </option>
							<option value='2001'> 2001 </option>
							<option value='2000'> 2000 </option>
							<option value='1999'> 1999 </option>
							<option value='1998'> 1998 </option>
							<option value='1997'> 1997 </option>
							<option value='1996'> 1996 </option>
							<option value='1995'> 1995 </option>
							<option value='1994'> 1994 </option>
							<option value='1993'> 1993 </option>
							<option value='1992'> 1992 </option>
							<option value='1991'> 1991 </option>
							<option value='1990'> 1990 </option>
							<option value='1989'> 1989 </option>
							<option value='1988'> 1988 </option>
							<option value='1987'> 1987 </option>
							<option value='1986'> 1986 </option>
							<option value='1985'> 1985 </option>
							<option value='1984'> 1984 </option>
							<option value='1983'> 1983 </option>
							<option value='1982'> 1982 </option>
							<option value='1981'> 1981 </option>
							<option value='1980'> 1980 </option>
							<option value='1979'> 1979 </option>
							<option value='1978'> 1978 </option>
							<option value='1977'> 1977 </option>
							<option value='1976'> 1976 </option>
							<option value='1975'> 1975 </option>
							<option value='1974'> 1974 </option>
							<option value='1973'> 1973 </option>
							<option value='1972'> 1972 </option>
							<option value='1971'> 1971 </option>
							<option value='1970'> 1970 </option							
					</select>
					</td>
					</tr>
				
					</tr>
            
					</table>
          
					<br />
					<input name=submit value=submit type=submit />
					<input name=reset value=reset type=reset />
					</form>";
        }

        if ($_COOKIE['role'] == 'admin')
        {
            $email_add = $_COOKIE['email_add'];

            $sql = "SELECT * FROM portalmanager WHERE email_add = '$email_add'";
            $run = mysqli_query($connect, $sql);
            while ($runrows = mysqli_fetch_array($run))
            {
                $first_name = $runrows['first_name'];
                $last_name = $runrows['last_name'];
                $description = $runrows['description'];
                $ic_number = $runrows['ic_number'];
                $postal_code = $runrows['postal_code'];
                $dob = $runrows['dob'];
            }




            $profileform = "<form enctype=multipart/form-data action=doProfile.php method=POST name=doProfile>
          
          
				<table width=473 border=0 cellpadding=10 cellspacing=2>
		  
				

				<tr>
				<td width=70 height=57><font size=2.5>First Name:</font></td>
				<td width=275><input type=text name =first_name id=first_name value= $first_name /></td>
				</tr>
			
				<tr>
				<td width=70 height=57><font size=2.5>Last Name:</font></td>
				<td><input type=text name= last_name id=last_name value = $last_name /></td>
				</tr>
			
			
				<tr>
				<td width=70 height=57><font  size=2.5>Description:</font></td>
				<td><textarea name = description id = description >$description </textarea></td>
				</tr>
			
			
				<tr>
				<td width=70 height=57><font size=2.5>IC Number:</font></td>
				<td width=275><input type=text name =ic_number id=ic_number value = $ic_number /></td>
				</tr>
			
				<tr>
				<td width=70 height=57><font size=2.5>Postal Code:</font></td>
				<td><input tpye=text name = postal_code id=postal_code value = $postal_code /></td>
				</tr>
                                
                                <tr>
				<td width=70 height=57><font size=2.5>You current DOB:</font></td>
				<td width=70 height=57>$dob</td>
				</tr>

			
				<tr>
				<td width=70 height=57><font  size=2.5> Date Of Birth*:</font></td>
				<td>
					<select name = 'day'>
							<option value='1'>  1  </option>
							<option value='2'>  2  </option>
							<option value='3'>  3  </option>
							<option value='4'>  4  </option>
							<option value='5'>  5  </option>
							<option value='6'>  6  </option>
							<option value='7'>  6  </option>
							<option value='8'>  8  </option>
							<option value='9'>  9  </option>
							<option value='10'> 10 </option>
							<option value='11'> 11 </option>
							<option value='12'> 12 </option>
							<option value='13'> 13 </option>
							<option value='14'> 14 </option>
							<option value='15'> 15 </option>
							<option value='16'> 16 </option>
							<option value='17'> 17 </option>
							<option value='18'> 18 </option>
							<option value='19'> 19 </option>
							<option value='20'> 20 </option>
							<option value='21'> 21 </option>
							<option value='22'> 22 </option>
							<option value='23'> 23 </option>
							<option value='24'> 24 </option>
							<option value='25'> 25 </option>
							<option value='26'> 26 </option>
							<option value='27'> 27 </option>
							<option value='28'> 28 </option>
							<option value='29'> 29 </option>
							<option value='30'> 30 </option>
							<option value='31'> 31 </option>
					</select>
				
				
					<select name = 'month'>
							<option value='1'>  January   </option>
							<option value='2'>  February  </option>
							<option value='3'>  March     </option>
							<option value='4'>  April     </option>
							<option value='5'>  May       </option>
							<option value='6'>  June      </option>
							<option value='7'>  July      </option>
							<option value='8'>  August    </option>
							<option value='9'>  September </option>
							<option value='10'> October   </option>
							<option value='11'> November  </option>
							<option value='12'> December  </option>
					</select>
					
					<select name = 'year'>
							
							<option value='2010'> 2010 </option>
							<option value='2009'> 2009 </option>
							<option value='2008'> 2008 </option>
							<option value='2007'> 2007 </option>
							<option value='2006'> 2006 </option>
							<option value='2005'> 2005 </option>
							<option value='2004'> 2004 </option>
							<option value='2003'> 2003 </option>
							<option value='2002'> 2002 </option>
							<option value='2001'> 2001 </option>
							<option value='2000'> 2000 </option>
							<option value='1999'> 1999 </option>
							<option value='1998'> 1998 </option>
							<option value='1997'> 1997 </option>
							<option value='1996'> 1996 </option>
							<option value='1995'> 1995 </option>
							<option value='1994'> 1994 </option>
							<option value='1993'> 1993 </option>
							<option value='1992'> 1992 </option>
							<option value='1991'> 1991 </option>
							<option value='1990'> 1990 </option>
							<option value='1989'> 1989 </option>
							<option value='1988'> 1988 </option>
							<option value='1987'> 1987 </option>
							<option value='1986'> 1986 </option>
							<option value='1985'> 1985 </option>
							<option value='1984'> 1984 </option>
							<option value='1983'> 1983 </option>
							<option value='1982'> 1982 </option>
							<option value='1981'> 1981 </option>
							<option value='1980'> 1980 </option>
							<option value='1979'> 1979 </option>
							<option value='1978'> 1978 </option>
							<option value='1977'> 1977 </option>
							<option value='1976'> 1976 </option>
							<option value='1975'> 1975 </option>
							<option value='1974'> 1974 </option>
							<option value='1973'> 1973 </option>
							<option value='1972'> 1972 </option>
							<option value='1971'> 1971 </option>
							<option value='1970'> 1970 </option							
					</select>
					</td>
					</tr>
				
					</tr>
            
					</table>
          
					<br />
					<input name=submit value=submit type=submit />
					<input name=reset value=reset type=reset />
					</form>";
        }
    }
    mysqli_close($connect);
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
                        <a href="http://facebook.com/stefanusz" title="Join us at Facebook!"><img src="administrator/socialnetwork/facebook.png" width="67" height="72" alt="Facebook" longdesc="http://facebook.com/stefanusz" /></a><a href="http://twitter.com/stefanusz" title="Join us at Twitter!"><img src="administrator/socialnetwork/3.png" width="67" height="72" alt="Twitter" longdesc="http://twitter.com/stefanusz" /></a> </p>
                </div>
                <!-- 75 percent width column, aligned to the right -->
                <div class="width75 floatRight"> 

                    <!-- Gives the gradient block -->
                    <div class="gradient"> <a name="fluidity"></a>
                        <h1>Manage Your Profile!</h1>
                        <h2>Please fill in those fields that you want to update! Thank you! </h2>
                        <p> <?php echo "$profileform"; ?> <?php echo "$dbemail_add"; ?> </p>
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