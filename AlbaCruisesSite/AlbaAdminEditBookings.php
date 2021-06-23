<!DOCTYPE HTML>
<!-- Page to edit bookings -->
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

            <div id="centerBlockDiv">

                Book Journey:
                <form method="post" action="AlbaCruisesAdminExecuteBooking.php">           


                    <tr>
                        <td>Customer Email address:</td>
                        <td><input required type="email" name="Email" size="25" id="AccountName" /></td> <!-- asks the user for their email address to be validated -->
                    </tr>
                    <table>


                        <select name="Journey">  

                            <option selected hidden>Route</option>             
                            <!--                        Borealid (27/12/12) "How can I set the default value for an HTML <select> element?"  available at: //stackoverflow.com/questions/3518002/how-can-i-set-the-default-value-for-an-html-select-element (10/05/2019)   a default value which will not be used-->

                            <?php

                            include("AlbaCruisesServerCode/Connect.php");             // Add in the database connection details


                            $Query = "SELECT Route.route, Route.routeNo, Journey.journeyNo, Journey.sailingDate, Journey.departTime FROM Route, Journey WHERE Journey.routeNo = Route.routeNo";  

                            $Result = mysqli_query($DB,$Query);

                            while($row = mysqli_fetch_assoc($Result)){

                                echo "<option value=" . $row["journeyNo"] . ">" . $row["route"] . " On " . $row["sailingDate"] . " at " . $row["departTime"] . "</option>";      //echo data for select to html

                            }

                            ?>

                        </select>  


                        <!--      select for customers to choose quantity -->
                        <tr>
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
                        </tr>
                        <!--                       radio buttons to choose whether or not disability seat needed  -->
                        <tr>
                            <input type="radio" id="disSeat" name="disSeat" value="0" checked="checked">        
                            <label for="disSeat">Disability Seat not required</label>
                        </tr>
                        <tr>
                            <input type="radio" id="disSeat" name="disSeat" value="1">
                            <label for="disSeat">Disability Seat required</label>
                        </tr>
                        <tr>
                            <td colspan="2"><input class="button" type="submit" value="Add" /></td> <!-- submits the user entered information -->
                        </tr>
                    </table>
                </form>

            </div>


            <div id="rightBlockDiv">


                Delete Booking:
                <form method="post" action="AlbaCruisesAdminDeleteBooking.php">

                    <tr>
                        <td>Customer Email address:</td>
                        <td><input required type="email" name="Email" size="25"/></td> <!-- asks the user for their email address to be validated -->
                    </tr>

                    <tr>
                        <td>Booking Number:</td>
                        <td><input required type="text" name="Booking" size="25"/></td> <!-- asks the user for their email address to be validated -->
                    </tr>
                    <br>
                    <tr>
                        <td colspan="2"><input class="button" type="submit" value="Delete" /></td> <!-- submits the user entered information -->
                    </tr>
                </form>
            </div>

        </div>
    </body>

</html>