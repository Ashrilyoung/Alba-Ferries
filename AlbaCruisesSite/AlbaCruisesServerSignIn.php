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
            <div id="leftBlockDiv">

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


                $Email	     = $_POST['Email'];                             //variables which were entered on the previous page
                $Password 	 = $_POST['Password'];




                //example of prepeared statements taken from an example given in class
                //w3schools (unknown) "PHP Prepared Statements" Available at: https://www.w3schools.com/php/php_mysql_prepared_statements.asp (10/05/2019)

                $stmt = $DB->stmt_init();    //initialise the statement


                if($stmt->prepare("SELECT password, isAdmin, accountNo FROM Account WHERE emailAddress = ?")){  //prepeare the statament


                    $stmt->bind_param('s',$Email);  //the s here represents a string that we want to bind $EMAIL to. if there were more peramaters just add more s's and the other parameter

                    $stmt->execute();   //executes the statement

                    $stmt->bind_result($UserPassword, $isAdmin, $accountNo);  //bind the results to php variables

                    if($stmt->fetch()){           
                        if (password_verify($Password, $UserPassword)) {             //compares the hashed password from the darabase to the password just entered
                            // Success!
                            $cookie_name_isAdmin = "isAdmin";                                          //cookie name
                            $cookie_name_accountNo = "accountNo";   
                            setcookie($cookie_name_isAdmin, $isAdmin, time() + (86400 * 30), "/"); // w3schools (unknown) "PHP setcookie() Function" Available at: https://www.w3schools.com/php/func_http_setcookie.asp (17/05/2019)  set the usernumber for use later
                            setcookie($cookie_name_accountNo, $accountNo, time() + (86400 * 30), "/");

                            if(isset($_COOKIE[$cookie_name_isAdmin], $_COOKIE[$cookie_name_accountNo])){  //if the cookie set properly to a value

                                if($isAdmin == '1'){
                                    header('Location: http://ec2-18-135-180-152.eu-west-2.compute.amazonaws.com/AlbaCruisesSite/AlbaAdminHomepage.php');
                                } else if($isAdmin == '0'){
                                    header('http://ec2-18-135-180-152.eu-west-2.compute.amazonaws.com/AlbaCruisesSite/AlbaCruisesCustomerHomepage.php');   
                                }
                            } echo 'The cookie is not set.';

                        } echo "Sorry Your Username or Password do not match. Please check your details and try again";


                    }else{
                        echo 'The Details you have entered are incorrect please try again.';
                    }       

                }
                ?>


                <form method="get" action="AlbaCruisesLogIn.php">
                    <button class="button" type="submit">Return</button>
                </form>

            </div>
        </div>
    </body>

</html>
