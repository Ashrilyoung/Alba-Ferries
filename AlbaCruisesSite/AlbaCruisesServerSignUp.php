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



                <?php

                include("AlbaCruisesServerCode/Connect.php");                                  //links to a page which will connect to the Database

                $Name	     = $_POST['Name'];                             //variables which were entered on the previous page
                $Email 	 = $_POST['Email'];
                $Password	     = $_POST['Password'];                             
                $PhoneNo 	 = $_POST['PhoneNo'];
                $Address	     = $_POST['Address'];
                $Postcode      = $_POST['Postcode'];

                //w3schools (unknown) "PHP Prepared Statements" Available at: https://www.w3schools.com/php/php_mysql_prepared_statements.asp (10/05/2019)

                $hash = password_hash($Password, PASSWORD_DEFAULT);     // Sandeep Panda (16/09/2013) "" Available at: https://www.sitepoint.com/hashing-passwords-php-5-5-password-hashing-api/ (23/05/2019)


                $stmt = $DB->stmt_init();    //initialise the statement


                if($stmt->prepare("INSERT INTO Account (`name`,`emailAddress`,`password`,`address`,`postCode`,`phoneNo`,`isAdmin`) VALUES ('$Name', '$Email', '$hash', '$Address', '$Postcode',  '$PhoneNo', '0')")){      //sql query to check whether the supplied user data corresponds with an account on the database

                    $stmt->bind_param('ssssss', $Name, $Email, $hash, $Address, $Postcode,  $PhoneNo);  //binds the email and password to the s's

                    $stmt->execute();   //executes the statement

                    if($stmt->affected_rows > 0){

                        echo "Your Account Has been created Successfully!";                 //if successful button to take user to log in page
                        echo '<form method="get" action="AlbaCruisesLogIn.php">';
                        echo '<button class="button" type="submit">Log In</button>';
                        echo "</form>";


                    }else{

                        echo "There has been an error creating the Account. Please check your information and try again";             //if register unsuccessful link back to previous page so user can try again
                        echo '<form method="get" action="AlbaCruisesSIgnUp.php">';
                        echo '<button class="button" type="submit">Return</button>';
                        echo "</form>";
                    }}

                ?>



            </div>
        </div>
    </body>

</html>