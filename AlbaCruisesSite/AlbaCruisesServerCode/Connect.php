<?php

DEFINE ('DB_USER', 'AlbaCruises');                                   //use these details to connect to the database
DEFINE ('DB_PASSWORD', 'AlbaCrooses1999');                       
DEFINE ('DB_HOST', 'localhost');                     
DEFINE ('DB_NAME', 'AlbaCruisesDB');                           
@$DB = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
if (mysqli_connect_errno())                                                //if there is an error preventing connection display an error message
{
    echo 'Cannot connect to the database: ' . mysqli_connect_error();
}
?>

