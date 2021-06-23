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
                <table border="10" bordercolor=#000000>

                    <tr>
                        <th>Booking No</th>
                        <th>Route</th>
                        <th>Sailing Date</th>
                        <th>Depart Time</th>
                        <th>No of Tickets</th>
                    </tr>



                    <?php

                    include("AlbaCruisesServerCode/Connect.php");             // Add in the database connection details


                    $AccountNo = $_COOKIE['accountNo'];


                    $Query = "SELECT Booking.bookingNo, Route.route, Journey.sailingDate, Journey.departTime, Booking.ticketQuantity FROM Booking, Journey, Route WHERE Booking.journeyNo= Journey.journeyNo AND Journey.routeNo  = Route.RouteNo AND AccountNo = '$AccountNo' GROUP BY Booking.bookingNo";

                    $Result = mysqli_query($DB,$Query);

                    while($row = mysqli_fetch_assoc($Result)){
                        echo "<tr>";
                        echo "<td>" . $row["bookingNo"] . "</td>";
                        echo "<td>" . $row["route"] . "</td>";
                        echo "<td>" . $row["sailingDate"] . "</td>";
                        echo "<td>" . $row["departTime"] . "</td>";
                        echo "<td>" . $row["ticketQuantity"] . "</td>";
                        echo "</tr>";

                    }

                    ?>

                </table>

            </div>

            <div id="centerBlockDiv">


                Delete Booking:
                <form method="post" action="AlbaCruisesDeleteBooking.php">
                    <!-- if this button is clicked it will link the user to this page -->
                    <table>
                        <select  name="Journey">

                            <option selected hidden>Journey Number</option>             
                            <!--                        Borealid (27/12/12) "How can I set the default value for an HTML <select> element?"  available at: //stackoverflow.com/questions/3518002/how-can-i-set-the-default-value-for-an-html-select-element (10/05/2019)   a default value which will not be used-->

                            <?php

                            include("AlbaCruisesServerCode/Connect.php");             // Add in the database connection details


                            $AccountNo = $_COOKIE['accountNo'];

                            $Query = "SELECT bookingNo FROM Booking WHERE accountNo = '$AccountNo' GROUP BY bookingNo";

                            $Result = mysqli_query($DB,$Query);

                            while($row = mysqli_fetch_assoc($Result)){

                                echo "<option value=" . $row["bookingNo"] . ">" . $row["bookingNo"] ."</option>";      

                            }

                            ?>

                        </select>  
                    </table>
                    <tr>
                        <td colspan="2"><input class="button" type="submit" value="Delete" /></td> <!-- submits the user entered information -->
                    </tr>
                </form>
            </div>


            <br>
            <div id="rightBlockDiv">

                Edit Booking:
                <form method="post" action="AlbaCruisesEditBooking.php">

                    <table>
                        <select  name="BookingNo">

                            <option selected hidden>Journey Number</option>             
                            <!--                        Borealid (27/12/12) "How can I set the default value for an HTML <select> element?"  available at: //stackoverflow.com/questions/3518002/how-can-i-set-the-default-value-for-an-html-select-element (10/05/2019)   a default value which will not be used-->

                            <?php

                            include("AlbaCruisesServerCode/Connect.php");             // Add in the database connection details


                            $AccountNo = $_COOKIE['accountNo'];

                            $Query = "SELECT bookingNo FROM Booking WHERE accountNo = '$AccountNo' GROUP BY bookingNo";

                            $Result = mysqli_query($DB,$Query);

                            while($row = mysqli_fetch_assoc($Result)){

                                echo "<option value=" . $row["bookingNo"] . ">" . $row["bookingNo"] ."</option>";      

                            }

                            ?>

                        </select>  

                        <tr>
                            New Ticket Quantity:
                            <select name="Quantity">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                    </table>
                    <tr>
                        <td colspan="2"><input class="button" type="submit" value="Update" /></td> <!-- submits the user entered information -->
                    </tr>
                </form>
            </div>
        </div>
    </body>

</html>