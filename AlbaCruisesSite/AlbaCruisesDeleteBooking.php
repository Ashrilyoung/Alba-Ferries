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

            $bookingNo     =  $_POST['Journey'];                             //variables which were entered on the previous page  
            $AccountNo = $_COOKIE['accountNo'];


            $Query1 = "UPDATE Journey SET RT = (RT + (SELECT ticketQuantity FROM Booking WHERE accountNo = '$AccountNo' AND bookingNo = '$bookingNo' GROUP BY journeyNo)) WHERE journeyNo = (SELECT journeyNo FROM Booking WHERE bookingNo = '$Booking')";

            $Result1 = mysqli_query($DB,$Query1);

            if ($Result1 !== false){

                $stmt = $DB->stmt_init();    //initialise the statement

                //w3schools (unknown) "PHP Prepared Statements" Available at: https://www.w3schools.com/php/php_mysql_prepared_statements.asp (10/05/2019)
                if($stmt->prepare("DELETE FROM Booking WHERE bookingNo = '$bookingNo' AND accountNo = '$AccountNo'")){     //sql query to check whether the supplied user data corresponds with an account on the database

                    $stmt->bind_param('ss', $bookingNo, $AccountNo);  //binds the email and password to the s's

                    $stmt->execute();   //executes the statement

                    if($stmt->affected_rows > 0){

                        echo "Your Booking Has been Deleted Successfully!";


                    }else{

                        echo "There has been an error deleting Booking Please try again";
                    }}}

            ?>

            <form method="get" action="CustomerEditBookings.php">
                <button class="button" type="submit">Return</button>
            </form>
        </div>
    </body>

</html>