<!DOCTYPE HTML>
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" type="text/css" media="screen" href="AlbaCruisesCSS/AlbaCruisesStyle.css">

        <title>Alba Cruises</title>


        <style>
            background-image: url("AlbaCruisesImages/AlbaCruisesLandscapes1.jpg");

        </style>

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

            <h1>Frequent Customer Ceilidh</h1>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus in purus in nunc maximus accumsan. Cras sed justo ac augue convallis lacinia. Nunc vitae commodo tellus. Proin finibus ultricies massa eu dictum. Nunc sed odio sit amet libero tincidunt tempor non eu ante. Etiam ut eros eu lacus blandit posuere. Morbi lacus eros, suscipit gravida ligula a, blandit mattis nunc. Sed ut sodales felis. Vestibulum malesuada et velit lacinia interdum. Donec consequat quam ut est imperdiet, sed aliquet leo aliquet. Pellentesque eu leo ullamcorper metus posuere vestibulum at eget dolor.

            Nulla consequat rhoncus tortor, ut pretium tortor hendrerit id. Curabitur lobortis lectus massa, nec cursus dui ornare a. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris quis egestas turpis, vel malesuada quam. Phasellus non rutrum dolor. Praesent lacus lorem, fringilla faucibus sodales at, finibus sed nulla. Donec rhoncus augue ex, eu sagittis lectus vestibulum consectetur. Proin volutpat venenatis iaculis. Nulla sed felis eget nunc malesuada commodo. In vel laoreet nisi, vel posuere justo. Duis eros odio, faucibus nec volutpat sed, ornare a odio. Nunc feugiat diam diam, ullamcorper congue ipsum viverra vel.

            <img src="AlbaCruisesImages/AlbaCruisesLandscapes1.jpg" alt="Scottish Landscape" style="width:1185px;" >
        </div>
    </body>

</html>