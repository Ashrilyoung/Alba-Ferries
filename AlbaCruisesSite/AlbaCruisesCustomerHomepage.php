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
                Make Bookings:
                <form method="post" action="AlbaCruisesCustomerBook.php">
                    <td colspan="2"><input class="button" type="submit" value="Make Bookings" /></td>
                </form>

            </div>



            <?php

            include("AlbaCruisesServerCode/Connect.php");             // Add in the database connection details

            $AccountNo = $_COOKIE['accountNo'];

            $Query = "SELECT count(bookingNo) FROM `Booking` WHERE accountNo = '$AccountNo'"; 

            $Result = mysqli_query($DB,$Query);

            while($row = mysqli_fetch_assoc($Result)){

                $noOfTrips = $row["count(bookingNo)"];         //get the number of trips the customer has booked

            }
 
            if($noOfTrips >= 3){              //show customer ceilidh if they are a repeat customer
                echo "You Have Been Invited to the Frequent Customer Ceilidh:";
                echo "<form method='post' action='FrequentCustomerCeilidh.php'>";
                echo " <td colspan='2'><input class='button' type='submit' value='Customer Ceilidh' /></td>"; 
                echo " </form>";
            }

            ?>





        </div>
    </body>

</html>