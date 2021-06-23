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
                        <th>Route Name</th>
                        <th>Sailing Date</th>
                        <th>Boarding Time</th>
                        <th>Seats Remaining</th>
                    </tr>



                    <?php

                    include("AlbaCruisesServerCode/Connect.php");             // Add in the database connection details


                    //table shows under occupancy of journys

                    $Query = "SELECT Route.route, Journey.sailingDate, Journey.departTime, Journey.RT FROM Journey, Route WHERE Route.routeNo = Journey.routeNo";

                    $Result = mysqli_query($DB,$Query);

                    while($row = mysqli_fetch_assoc($Result)){
                        echo "<tr>";
                        echo "<td>" . $row["route"] . "</td>";
                        echo "<td>" . $row["sailingDate"] . "</td>";
                        echo "<td>" . $row["departTime"] . "</td>";
                        echo "<td>" . $row["RT"] . "</td>"; 
                        echo "</tr>";

                    }

                    ?>

                </table>

            </div>

        </div>
    </body>

</html>