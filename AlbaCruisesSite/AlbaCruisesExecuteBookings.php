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

            $Journey	     =  $_POST['Journey'];                             //variables which were entered on the previous page  
            $Quantity	     =  $_POST['Quantity']; 
            $Authorisation = "Online";
            $AccountNo = $_COOKIE['accountNo'];
            $disabilitySeating	     =  $_POST['disSeat'];


            //w3schools (unknown) "PHP Prepared Statements" Available at: https://www.w3schools.com/php/php_mysql_prepared_statements.asp (10/05/2019)

            $stmt = $DB->stmt_init();    //initialise the statement


            //borrowed from https://stackoverflow.com/questions/2090475/checking-if-a-number-is-divisible-by-6-php


            $Query = "SELECT disSpotTaken FROM Journey WHERE journeyNo = '$Journey'";

            $Result = mysqli_query($DB,$Query);

            while($row = mysqli_fetch_assoc($Result)){

                $disTaken = $row['disSpotTaken'];
            }

            if ($disTaken == '1' AND $disabilitySeating == '1'){
                echo "Apologies the disabled seating is already taken.";

            }else {

                $Query2 = "SELECT RT FROM `Journey` WHERE journeyNo = '$Journey'";

                $Result2 = mysqli_query($DB,$Query2);

                while($row = mysqli_fetch_assoc($Result2)){

                    $seatsTaken = $row['RT'];
                }

                if(($seatsTaken - $Quantity) > 0){

                    if($Quantity % 6 != 0){

                        if($stmt->prepare("INSERT INTO `Booking` (`bookingNo`,`accountNo`,`journeyNo`,`authorisedBy`, `ticketQuantity`, `totalFare`, `disabledSeating`) VALUES (NULL, '$AccountNo', '$Journey', '$Authorisation', '$Quantity', (SELECT (Route.fares*'$Quantity') FROM Route, Journey WHERE Journey.routeNo = Route.routeNo AND Journey.routeNo = (SELECT routeNo FROM `Journey` WHERE journeyNo = '$Journey') GROUP BY (Route.fares*'$Quantity')), $disabilitySeating)")){     //sql query to check whether the supplied user data corresponds with an account on the database

                            $stmt->bind_param('ssss', $AccountNo, $Journey, $Authorisation, $Quantity);  //binds the email and password to the s's

                            $stmt->execute();   //executes the statement

                            if($stmt->affected_rows > 0){

                                $Query1 = "UPDATE `Journey` SET `RT`= (RT - '$Quantity'), disSpotTaken = '$disabilitySeating' WHERE `journeyNo`='$Journey'";

                                $Result1 = mysqli_query($DB,$Query1);

                                if ($Result1 !== false){

                                    header('Location: http://ec2-18-135-180-152.eu-west-2.compute.amazonaws.com/AlbaCruisesSite/AlbaCruisesPrintablePasses.php');

                                }

                            }else{

                                echo "There has been an error Booking Please try again";
                            }
                        }
                    } else {

                        if($stmt->prepare("INSERT INTO `Booking` (`bookingNo`,`accountNo`,`journeyNo`,`authorisedBy`, `ticketQuantity`, `totalFare`, `disabledSeating`) VALUES (NULL, '$AccountNo', '$Journey', '$Authorisation', '$Quantity', (SELECT (Route.fares*'$Quantity' - (('$Quantity' * Route.fares)/12)) FROM Route, Journey WHERE Journey.routeNo = Route.routeNo AND Journey.routeNo = (SELECT routeNo FROM `Journey` WHERE journeyNo = '$Journey') GROUP BY (Route.fares*'$Quantity')), $disabilitySeating)")){     //sql query to check whether the supplied user data corresponds with an account on the database

                            $stmt->bind_param('ssss', $AccountNo, $Journey, $Authorisation, $Quantity);  //binds the email and password to the s's

                            $stmt->execute();   //executes the statement

                            if($stmt->affected_rows > 0){

                                $Query1 = "UPDATE `Journey` SET `RT`= (RT - '$Quantity'), disSpotTaken = '$disabilitySeating'  WHERE `journeyNo`='$Journey'";

                                $Result1 = mysqli_query($DB,$Query1);

                                if ($Result1 !== false){

                                    header('Location: http://ec2-18-135-180-152.eu-west-2.compute.amazonaws.com/AlbaCruisesSite/AlbaCruisesPrintablePasses.php');

                                }

                            }else{

                                echo "There has been an error Booking Please try again";
                            }
                        }


                    }

                } else {
                    echo "Apologies there are not enough seats left in that Ship.";
                }
            }


            ?>


            <?php
            
                echo "<form method='get' action='AlbaCruisesCustomerBook.php'>";  //display a button for the user to go back to the bookings page
                echo "<button class='button' type='submit'>Return</button>";
                echo "<button class='button' type='submit'>Pay</button>";
                echo "</form>";
            

            ?>


        </div>
    </body>

</html>
