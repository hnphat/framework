<?php
define("ALLOW",1);
include 'apps/autoload.php';
$unity = new Apps_Class_Unity();
$topic = new Apps_Control_Topic();
//----------------- Dữ liệu tin tức -----------------------------
$id = $unity->getNumberFromString($unity->getTheSecondLink(isset($_GET['do']) ? $_GET['do'] : ""));
$queryWhere = [
    "select" => "*",
    "where" => "topic_id = ".$id.""
];
$topic->setQuery($queryWhere);
$dataTopic = $topic->getResultFromSelectQuery($topic->queryData());
//----------------------------------------------
$item = new Apps_Control_Item();
$subitem = new Apps_Control_Subitem();
$query = [
    "select" => "*"
];
$item->setQuery($query);
$subitem->setQuery($query);
$dataItem = $item->getResultFromSelectQuery($item->queryData());
$dataSubItem = $subitem->getResultFromSelectQuery($subitem->queryData());
?>
<!DOCTYPE html>
<html lang="vi-VN">
<head>
    <title>HNP Solutions</title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <link rel="shortcut icon" href="admin/resource/image/logo.png"/>
    <meta name="author" content="HNP Solutions"/>
    <meta name="description" content="Dịch vụ thiết kế website, SEO Website, Facebook ads, Google Ads, ứng dụng web, công nghệ 2.0, tin tức công nghệ"/>
    <meta name="keywords"
          content="HNP Solution,lập trình, thiết kế web, SEO, facebook ads, google ads"/>
    <meta name="revisit-after" content="1 days"/>
    <meta name="robots" content="INDEX, FOLLOW"/>
    <?php
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    echo "<link rel=\"canonical\" href=\"$actual_link\"/>";
    ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="script/main.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/mystyle.css">
    <style>
        h1, h2, h3, h4, h5, h6, p, a {
            font-family: 'Roboto', sans-serif;
        }
        * {
            box-sizing: border-box;
        }
        #oz-scroll {
            position:fixed;
            bottom:20px;
            right:-80px;
            height:48px;
            width:48px;
            overflow:hidden;
            display:none;
            zoom:1;
            filter:alpha(opacity=60);
            opacity:.6;
            -webkit-transition:all .5s ease-in-out;
            -moz-transition:all .5s ease-in-out;
            -ms-transition:all .5s ease-in-out;
            -o-transition:all .5s ease-in-out;
            transition:all .5s ease-in-out;
        }
        #oz-scroll img {max-width:100%}
        #oz-scroll:hover {opacity:1}
        .style2 {background-image:url('image/oz-scroll-up/style2.png')}
    </style>
</head>
<body>
<header class="container">
    <div class="row">
        <div class="col-md-3">
            <a href="trang-chu.html"><img src="admin/resource/image/logo.png" alt="logo hnp solutions" class="img-fluid" width="200"/></a>
        </div>
        <div class="col-md-9">
            <div style="color: black; font-size:34pt;">
                <a style="border-bottom: 3px solid dodgerblue;" href="#" class="typewrite" data-period="2000" data-type='[ "Uy tín", "Chất lượng", "Chuyên nghiệp", "Hỗ trợ nhiệt tình", "Giá trị cốt lõi", "Giải pháp toàn diện"]'>
                    <span class="wrap"></span>
                </a>
                <script>
                    //made by vipul mirajkar thevipulm.appspot.com
                    var TxtType = function(el, toRotate, period) {
                        this.toRotate = toRotate;
                        this.el = el;
                        this.loopNum = 0;
                        this.period = parseInt(period, 10) || 1000;
                        this.txt = '';
                        this.tick();
                        this.isDeleting = false;
                    };

                    TxtType.prototype.tick = function() {
                        var i = this.loopNum % this.toRotate.length;
                        var fullTxt = this.toRotate[i];

                        if (this.isDeleting) {
                            this.txt = fullTxt.substring(0, this.txt.length - 1);
                        } else {
                            this.txt = fullTxt.substring(0, this.txt.length + 1);
                        }

                        this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

                        var that = this;
                        var delta = 200 - Math.random() * 100;

                        if (this.isDeleting) { delta /= 2; }

                        if (!this.isDeleting && this.txt === fullTxt) {
                            delta = this.period;
                            this.isDeleting = true;
                        } else if (this.isDeleting && this.txt === '') {
                            this.isDeleting = false;
                            this.loopNum++;
                            delta = 500;
                        }

                        setTimeout(function() {
                            that.tick();
                        }, delta);
                    };

                    window.onload = function() {
                        var elements = document.getElementsByClassName('typewrite');
                        for (var i=0; i<elements.length; i++) {
                            var toRotate = elements[i].getAttribute('data-type');
                            var period = elements[i].getAttribute('data-period');
                            if (toRotate) {
                                new TxtType(elements[i], JSON.parse(toRotate), period);
                            }
                        }
                        // INJECT CSS
                        var css = document.createElement("style");
                        css.type = "text/css";
                        css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
                        document.body.appendChild(css);
                    };
                </script>
            </div>
        </div>
    </div>
</header>
<div class="container-fluid sticky-top" style="background-color: #669900;">
    <nav class="container navbar navbar-expand-md">
        <a href="trang-chu.html" class="navbar-brand text-light"><span class="fa fa-home" style="font-size:120%;"></span></a>
        <button class="navbar-toggler text-light" type="button" data-toggle="collapse" data-target="#collapseNavBar">
            <span class="fa fa-align-justify"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapseNavBar">
            <ul class="navbar-nav">
                <?php
                $flag = true;
                for ($i = 0; $i < count($dataItem); $i++) {
                    if ($subitem->checkHaveItem($dataItem[$i]['item_id'], $dataSubItem)) {
                        echo "<li class=\"nav-item\">
                    <div class=\"dropdown\">
                        <a href=\"#\" class=\"nav-link dropdown-toggle text-light\" data-toggle=\"dropdown\">" . $dataItem[$i]['item_name'] . "</a>
                        <div class=\"dropdown-menu\">";
                        for ($j = 0; $j < count($dataSubItem); $j++) {
                            if ($dataItem[$i]['item_id'] == $dataSubItem[$j]['item_id'])
                                echo "<a href=\"".$dataSubItem[$j]['subitem_link']."\" class=\"dropdown-item\">".$dataSubItem[$j]['subitem_name']."</a>";
                        }
                        echo "</div></div></li>";
                    } else {
                        echo " <li class=\"nav-item\">
                    <a href=\"" . $dataItem[$i]['item_link'] . "\" class=\"nav-link text-light\">" . $dataItem[$i]['item_name'] . "</a>
                </li>";
                    }
                }
                ?>
            </ul>
        </div>
    </nav>
</div>
<?php
(isset($_GET['do'])) ? $do = $_GET['do'] : $do = 'trang-chu';
include 'do.php';
?>
<footer class="container-fluid p-1" style="background: #DDDDDD;">
    <ul class="nav justify-content-center">
        <?php
        for($i = 0; $i < count($dataItem); $i++){
            echo "<li class=\"nav-item\">
                <a class=\"nav-link\" href=\"".$dataItem[$i]['item_link']."\">".$dataItem[$i]['item_name']."</a>
            </li>";
        }
        ?>
    </ul>
    <p class="text-center">© Copyright 2019 HNP Solutions. All rights reserved.</p>
</footer>
<a href="tel:0869505019"><img src="image/index/calling.gif" alt="calling" style="position: fixed; left:0;bottom:0;height:100px;"></a>
<!-- -->
<a id="oz-scroll" class="style2" href="#"></a>
<!-- End Scroll To Top Button -->
<script src="script/oz-scroll-up.js"></script>
<!-- -->
</body>
</html>
