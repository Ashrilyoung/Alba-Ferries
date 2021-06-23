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
        $isAdmin = $_COOKIE['isAdmin'];
        if($isAdmin == '1'){
            include("AlbaCruisesUi/AlbaCruisesAdminNavBar.php");
        }else{
            header('Location: http://ec2-18-135-180-152.eu-west-2.compute.amazonaws.com/AlbaCruisesSite/AlbaCruisesHomepage.php');  //if the user is not an admin send them to the homepage
        }
        ?>

        <div id="bodyContent">

            <div id="centerBlockDiv">

                <form method="post" action="AlbaCruisesMIS.php">
                    <td colspan="2"><input class="button"  type="submit" value="View Under Occupancy Statistics" /></td>
                </form>

                <form method="post" action="AlbaAdminEditBookings.php">
                    <!-- if this button is clicked it will link the user to this page -->
                    <td colspan="2"><input class="button" type="submit" value="Make Bookings" /></td> <!-- submits the user entered information -->
                </form>
            </div>

            <form method="post" action="AlbaCruisesBoardingLists.php">
                <!-- if this button is clicked it will link the user to this page -->
                <td colspan="2"><input class="button" type="submit" value="View Boarding Lists" /></td> <!-- submits the user entered information -->
            </form>

        </div>
    </body>

</html>