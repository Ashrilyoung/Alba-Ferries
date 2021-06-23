<!DOCTYPE HTML>
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" type="text/css" media="screen" href="AlbaCruisesCSS/AlbaCruisesStyle.css">

        <title>Alba Cruises</title>



    </head>

    <body>


         <?php
        $isAdmin = $_COOKIE['isAdmin'];     //check whether or not the user is on an admin account
        if($isAdmin == '1'){
            include("AlbaCruisesUi/AlbaCruisesAdminNavBar.php");      // if admin account use admin account
        }else{
            include("AlbaCruisesUi/AlbaCruisesNavBar.php");            //if user is not an admin use customer nav bar
        }
        ?>

        <div id="bodyContent">


            <div id="centerBlockDiv">

                Create Account:
                <form method="post" action="AlbaCruisesServerSignUp.php">
                    <!-- if this button is clicked it will link the user to this page -->
                    <table>


                        <tr>
                            <td>Name:</td>
                            <td><input required type="text" name="Name" size="25" id="Name" /></td> 
                        </tr>
                        <tr>
                            <td>Email address:</td>
                            <td><input required type="email" name="Email" size="25" id="EmailAddress" /></td> <!-- asks the user for their email address to be validated -->
                        </tr>

                        <tr>
                            <td>Password:</td>
                            <td><input required type="password" name="Password" size="20" /></td> <!-- asks the user to enter their password to be checked -->
                        </tr>
                        <tr>
                            <td>Phone Number:</td>
                            <td><input required type="text" name="PhoneNo" size="25" id="PhoneNumber" /></td> 
                        </tr>
                        <tr>
                            <td>Address:</td>
                            <td><input required type="text" name="Address" size="25" id="Address" /></td> 
                        </tr>
                        <tr>
                            <td>Postcode:</td>
                            <td><input required type="text" name="Postcode" size="8" id="Postcode" /></td> 
                        </tr>
                        <tr>
                            <td colspan="2"><input class="button" type="submit" value="Create Account" /></td> <!-- submits the user entered information -->
                        </tr>
                    </table>
                </form>


            </div>

        </div>
    </body>

</html>