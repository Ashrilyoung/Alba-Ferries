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

            <div id="leftBlockDiv">
                Log In:
                <form method="post" action="AlbaCruisesLogIn.php">
                    <td colspan="2"><input class="button"  type="submit" value="Log In" /></td>
                </form>
            </div>

            <div id="centerBlockDiv">

                Create Account:
                <form method="post" action="AlbaCruisesSIgnUp.php">
                    <!-- if this button is clicked it will link the user to this page -->
                    <td colspan="2"><input class="button" type="submit" value="Create Account" /></td> <!-- submits the user entered information -->
                </form>
            </div>
            
            <div id="rightBlockDiv">
                <form method="post" action="LocalAreaGuide.php">
                    <!-- if this button is clicked it will link the user to this page -->
                    <td colspan="2"><input class="button" type="submit" value="Local Area Guide" /></td> <!-- submits the user entered information -->
                </form>

            </div>
        </div>
    </body>

</html>