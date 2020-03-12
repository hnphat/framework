<?php
/**
 * Created by PhpStorm.
 * User: Microsoft Windows
 * Date: 12/07/2019
 * Time: 9:07 PM
 */
if (isset($_GET['file'])) {
    $myfile = fopen($_GET['file'], "r") or die("Unable to open file!");
// Output one line until end-of-file
    $arr = [];
    $dem = 0;
    while (!feof($myfile)) {
        //array_unshift($arr, fgets($myfile) . "<br>");
        //array_shift($arr, fgets($myfile) . "<br>");
        $arr[$dem] = fgets($myfile) . "<br>";
        $dem++;

    }
    fclose($myfile);
    // $temp = 1;
    // $arr2 = [];
    // for ($i = 0; $i < count($arr); $i++) {
    //     if ($temp != 30)
    //         array_unshift($arr2, $arr[$i]);
    //     else break;
    //     $temp++;
    // }

    // foreach ($arr2 as $value) {
    //     echo $value;
    // }
    $i = count($arr) - 1;
    $dem = 0;
    for ($i; $i >= $dem; $i--) {
        echo ($i + 1) . ": " . $arr[$i];
    }
} elseif ($handle = opendir('.')) {
    while (false !== ($entry = readdir($handle))) {

        if ($entry != "." && $entry != "..") {

            echo "$entry\n";
        }
    }
    closedir($handle);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Watch Log</title>
</head>
<body>
</body>
</html>
