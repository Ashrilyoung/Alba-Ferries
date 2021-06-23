<!DOCTYPE HTML>
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" type="text/css" media="screen" href="AlbaCruisesCSS/AlbaCruisesStyle.css">

        <title>Alba Cruises</title>



    </head>

    <body>


        <div id="bodyContent">

             <?php
        $isAdmin = $_COOKIE['isAdmin'];     //check whether or not the user is on an admin account
        if($isAdmin == '1'){
            include("AlbaCruisesUi/AlbaCruisesAdminNavBar.php");      // if admin account use admin account
        }else{
            include("AlbaCruisesUi/AlbaCruisesNavBar.php");            //if user is not an admin use customer nav bar
        }
        ?>


            <?php

            include("AlbaCruisesServerCode/Connect.php");                                  //links to a page which will connect to the Database

            $BookingNo     =  $_POST['BookingNo'];                             //variables which were entered on the previous page  
            $Quantity = $_POST['Quantity']; 


            $Query = "SELECT ticketQuantity, totalFare FROM Booking WHERE bookingNo = '$BookingNo'";

            $Result = mysqli_query($DB,$Query);

            while($row = mysqli_fetch_assoc($Result)){
                $oldTicketQuantity = $row['ticketQuantity'];
                $oldFare = $row['totalFare'];
            }

            $stmt = $DB->stmt_init();    //initialise the statement

            if($stmt->prepare("UPDATE `Booking` SET `ticketQuantity`='$Quantity', `totalFare`= ('$Quantity'/'$oldTicketQuantity')*('$oldFare') WHERE `bookingNo`='$BookingNo'")){     //sql query to check whether the supplied user data corresponds with an account on the database

                $stmt->bind_param('ssss', $Quantity, $oldTicketQuantity, $oldFare, $BookingNo);  //binds the email and password to the s's

                $stmt->execute();   //executes the statement

                if($stmt->affected_rows > 0){

                    echo "Your Booking Has been updated Successfully!";

                }else{

                    echo "There has been an error updating Booking Please check the data and try again";
                }
            }
            ?>

            <form method="get" action="CustomerEditBookings.php">
                <button class="button" type="submit">Return</button>
            </form>
        </div>
    </body>

</html>