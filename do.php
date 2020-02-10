<?php
/**
 * Created by PhpStorm.
 * User: Microsoft Windows
 * Date: 31/07/2019
 * Time: 7:30 PM
 */
defined("ALLOW") or die("<p style='text-align: center;'><img src='image/khoa.jpg' alt='lock'/></p>");
switch($do) {
    case "trang-chu": include "body.php"; break;
    case "tin-cong-nghe": include "view/handle/bai-viet.php"; break;
    default: include "router.php";
}

?>