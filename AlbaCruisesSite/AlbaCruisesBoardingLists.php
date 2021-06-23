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
            header('Location: http://ec2-18-135-180-152.eu-west-2.compute.amazonaws.com/AlbaCruisesSite/AlbaCruisesCustomerHomepage.php');
        }
        ?>

        <div id="bodyContent">


            <div id="centerBlockDiv">

                View Boarding List:
                <form method="post" action="AlbaCruisesShowBoardingList.php">
                    <!-- if this button is clicked it will link the user to this page -->
                    <table>

                        <select name="Route">

                            <option selected hidden>Route</option>             
                            <!--                        Borealid (27/12/12) "How can I set the default value for an HTML <select> element?"  available at: //stackoverflow.com/questions/3518002/how-can-i-set-the-default-value-for-an-html-select-element (10/05/2019)   a default value which will not be used-->

                            <?php

                            include("AlbaCruisesServerCode/Connect.php");             // Add in the database connection details


                            $Query = "SELECT Route.route, Route.routeNo, Journey.journeyNo, Journey.sailingDate, Journey.departTime FROM Route, Journey WHERE Journey.routeNo = Route.routeNo";

                            $Result = mysqli_query($DB,$Query);

                            while($row = mysqli_fetch_assoc($Result)){

                                echo "<option value=" . $row["journeyNo"] . ">" . $row["route"] . " On " . $row["sailingDate"] . " at " . $row["departTime"] . "</option>";      

                            }

                            ?>

                        </select>  

                    </table>
                    <tr>
                        <td colspan="2"><input class="button" type="submit" value="View" /></td> <!-- submits the user entered information -->
                    </tr>
                </form>
            </div>


        </div>

    </body>


</html>