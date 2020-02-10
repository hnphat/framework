<?php
/**
 * Created by PhpStorm.
 * User: Microsoft Windows
 * Date: 06/07/2019
 * Time: 10:26 AM
 */

switch ($mode) {
    case "home":
        include "home.php";
        break;
    case "menu":
        include "view/menu.php";
        break;
    case "topic":
        include "view/topic.php";
        break;
    case "add_topic":
        include "view/add_topic.php";
        break;
    case "upload":
        include "view/upload.php";
        break;
    case "slide":
        include "view/slide.php";
        break;
    case "logout":
        {
            unset($_SESSION['per']);
            echo "<script>window.open('index.php','_self');</script>";
        }
        break;
    default: echo "<div class='container'><h1 class='text-center text-danger'>Page not found!</h1></div>";
}

?>