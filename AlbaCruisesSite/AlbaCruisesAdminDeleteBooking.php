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
            $isAdmin = $_COOKIE['isAdmin'];
            if($isAdmin == '1'){
                include("AlbaCruisesUi/AlbaCruisesAdminNavBar.php");
            }else{
                header('Location: http://ec2-18-135-180-152.eu-west-2.compute.amazonaws.com/AlbaCruisesSite/AlbaCruisesCustomerHomepage.php'); //if the user is not an admin send them to the homepage
            }
            ?>

            <?php

            include("AlbaCruisesServerCode/Connect.php");                                  //links to a page which will connect to the Database

            $Booking     =  $_POST['Booking'];                             //variables which were entered on the previous page  
            $Email = $_POST['Email']; 


            //w3schools (unknown) "PHP Prepared Statements" Available at: https://www.w3schools.com/php/php_mysql_prepared_statements.asp (10/05/2019)

            $Query1 = "UPDATE Journey SET RT = (RT + (SELECT ticketQuantity FROM Booking WHERE accountNo = (SELECT accountNo FROM `Account` WHERE emailAddress = '$Email') AND bookingNo = '$Booking')) WHERE journeyNo = (SELECT journeyNo FROM Booking WHERE bookingNo = '$Booking')";

            $Result1 = mysqli_query($DB,$Query1);

            if ($Result1 !== false){

                $stmt = $DB->stmt_init();    //initialise the statement


                if($stmt->prepare("DELETE FROM Booking WHERE bookingNo = '$Booking' AND accountNo = (SELECT accountNo FROM `Account` WHERE emailAddress = '$Email')")){     //sql query to check whether the supplied user data corresponds with an account on the database

                    $stmt->bind_param('ss', $JourneyNo, $AccountNo);  //binds the email and password to the s's

                    $stmt->execute();   //executes the statement

                    if($stmt->affected_rows > 0){

                        echo "Your Booking Has been Deleted Successfully!";


                    }}else{

                    echo "There has been an error deleting Booking Please check the data and try again";
                }}

            ?>

            <form method="get" action="AlbaAdminEditBookings.php">
                <button class="button" type="submit">Return</button>
            </form>
        </div>
    </body>

</html>