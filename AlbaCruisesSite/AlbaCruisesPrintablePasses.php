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
            
            <h2>Printable Tickets</h2>


            <?php


            include("AlbaCruisesServerCode/Connect.php");                                  //links to a page which will connect to the Database


            $AccountNo = $_COOKIE['accountNo'];

            //borrowed from https://stackoverflow.com/questions/2090475/checking-if-a-number-is-divisible-by-6-php


            $Query = "SELECT Account.name, Route.route, Journey.sailingDate, Journey.departTime, Booking.ticketQuantity, Booking.bookingNo FROM Booking, Journey, Account, Route WHERE Route.routeNo = Journey.routeNo AND Booking.journeyNo = Journey.journeyNo AND Booking.accountNo = Account.accountNo AND Booking.bookingNo = (SELECT MAX(bookingNo) FROM Booking WHERE accountNo = '$AccountNo')";

            $Result = mysqli_query($DB,$Query);

            while($row = mysqli_fetch_assoc($Result)){#
                $BookingNo = $row['bookingNo'];
                $AccountName = $row['name'];
                $SailingRoute = $row['route'];
                $DepartDate = $row['sailingDate'];
                $DepartTime = $row['departTime'];
                $ticketQuantity = $row['ticketQuantity'];
            }

            if ($Result !== false){

                for ($x = 1; $x <= $ticketQuantity; $x++) {

                    echo "<div id = 'ticket' >";                              //echo passes for user to print off with specific user data
                    echo "Booking Number: $BookingNo";
                    echo "<br>";
                    echo "Passenger Name: $AccountName";
                    echo "<br>";
                    echo "Sailing Route: $SailingRoute";
                    echo "<br>";
                    echo "Depart Date: $DepartDate";
                    echo "<br>";
                    echo "Depart Time: $DepartTime";
                    echo "<br>";
                    echo "Ticket Number $x of $ticketQuantity";
                    echo "<br>";
                    echo "</div>";
                    echo "<br>";
                }

            }else{

                echo "There has been an error retrieving the tickets Please try again";
            }

            ?>


            <?php

                echo "<form method='get' action='AlbaCruisesCustomerBook.php'>";
                echo "<button class='button' type='submit'>Return</button>";
                echo "</form>";

            ?>


        </div>
    </body>

</html>