<?php
session_start();
define('ADMIN', 1);
include '../apps/showmodal.php';
include '../apps/autoload.php';
require_once "../admin/resource/phpexcel/Classes/PHPExcel.php";
$user = new Apps_Control_User();
if (isset($_POST['submit'])) {
    if (isset($_POST['user']))
        $username = $_POST['user'];
    if (isset($_POST['password'])) {
        $pass = $_POST['password'];
    }
    $query = [
        "select" => "*",
        "where" => "user_name = '" . $username . "' and user_password = '" . md5($pass) . "'"
    ];
    $user->setQuery($query);
    $result = $user->queryData();
    if ($user->isExistRow($result)) {
        $dataUser = $user->getResultFromSelectQuery($result);
        $_SESSION['per'] = 1;
        $_SESSION['name'] = $user->getOneRow($dataUser)['user_fullname'];
        echo "<script>
                showMessageSuccess('Đăng nhập thành công','index.php',500);
              </script>";
    } else echo "<script>
                showMessageWarning('Sai tài khoản hoặc mật khẩu','index.php',2000);
              </script>";
}
if (isset($_POST['update'])) {
    $h_id = (isset($_POST['h_id'])) ? $_POST['h_id'] : null;
    $username = (isset($_POST['account'])) ? $_POST['account'] : null;
    $userfullname = (isset($_POST['fullname'])) ? $_POST['fullname'] : null;
    $oldpass = (isset($_POST['oldpass'])) ? $_POST['oldpass'] : null;
    $password = (isset($_POST['password'])) ? $_POST['password'] : null;
    $password2 = (isset($_POST['password2'])) ? $_POST['password2'] : null;
    $check = [
        "select" => "*",
        "where" => "user_password ='" . md5($oldpass) . "'"
    ];
    $user->setQuery($check);
    $result = $user->queryData();
    if ($user->isExistRow($result)) {
        if ($password == $password2) {
            $param = [
                "user_name" => $username,
                "user_fullname" => $userfullname,
                "user_password" => md5($password)
            ];
            $query = [
                "where" => "user_id = '" . $h_id . "'"
            ];
            $user->setParam($param);
            $user->setQuery($query);
            if ($user->updateData())
            echo "<script>showMessageSuccess('Đã đổi mật khẩu','index.php',2000)</script>";
            else echo "<script>showMessageWarning('Đổi mật khẩu không thành công, kiểm tra phía máy chủ','index.php',2000)</script>";
        } else {
            echo "<script>showMessageWarning('Mật khẩu mới không khớp nhau','index.php',3000)</script>";
        }
    } else echo "<script>showMessageWarning('Mật khẩu hiện tại không đúng','index.php',3000)</script>";


}
$fullname = (isset($_SESSION['name'])) ? $_SESSION['name'] : "";
$query = [
    "select" => "*",
    "where" => "user_fullname = '" . $fullname . "'"
];
$user->setQuery($query);
$dataUser = $user->getOneRow($user->getResultFromSelectQuery($user->queryData()));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Administrator Control Panel</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- tinymce -->
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <script src="resource/tinymce/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: "#tomtat",
        });

        tinymce.init({
            selector: "#noidung",
            theme: "modern",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media | forecolor backcolor emoticons",
            image_advtab: true,
            templates: [
                {title: 'Test template 1', content: 'Test 1'},
                {title: 'Test template 2', content: 'Test 2'}
            ]
        });
        tinymce.init({selector: "#binhluan"});
    </script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        #noidung {
            height: 600px;
        }

        .modal_local {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0, 0, 0); /* Fallback color */
            background-color: rgb(0, 0, 0, 0.5); /* mediumseagreen; Black w/ opacity */
        }

        .modal_manual {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0, 0, 0); /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
        }

        .modal_content_new {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }


    </style>
</head>
<body class="myFontNormal">
<?php
if (isset($_SESSION['per']) && $_SESSION['per'] == 1) {
    ?>
    <nav class="container navbar navbar-expand-md">
        <a href="index.php"><img src="resource/image/logo.png" alt="logo" class="w3-image" width="100"/></a>
        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler text-black" type="button" data-toggle="collapse"
                data-target="#collapsibleNavbar">
            <span class="fa fa-align-justify"></span>
        </button>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-black text-bold" href="index.php?mod=menu">| Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-black text-bold" href="index.php?mod=topic">| Topic</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-black text-bold" href="index.php?mod=upload">| Upload</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-black text-bold" href="index.php?mod=slide">| Slide</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <p class="text-right"><span class="fa fa-history"></span>&nbsp;<a href="watch.php?file=log.txt" target="_blank">
                Debug </a> - <a href="#" class="text-info"
                                data-toggle='modal' <?php echo "onclick='editValue(\"" . $dataUser['user_id'] . "\",\"" . $dataUser['user_name'] . "\",\"" . $dataUser['user_fullname'] . "\",\"" . $dataUser['user_permission'] . "\")'"; ?>
                                data-target='#editMedal'>Đổi mật khẩu</a> - <span
                    class="font-weight-bold">Xin chào:</span> <span
                    class="text-danger"><?php if (isset($_SESSION['name'])) echo $_SESSION['name']; ?></span> -
            <span><a
                        href="index.php?mod=logout">Logout</a></span>
        </p>
    </div>
    <main>
        <?php
        (isset($_GET['mod'])) ? $mode = $_GET['mod'] : $mode = 'home';
        include '../apps/mod.php';
        ?>
    </main>
    <footer class="container">
        <p class="text-center">Web developer: HNP Solutions - Hyundai An Giang</p>
    </footer>
    <?php
} else {
    ?>
    <div style="width: 100%; height:100%; background: url('resource/image/login_bg.jpg') no-repeat center center;">
        <br>
        <br>
        <h1 class="text-center text-white">ĐĂNG NHẬP HỆ THỐNG</h1><br/>
        <div class="container w3-center" style="width: 400px;">
            <form action="index.php" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" id="user" name="user" required="required"
                           autofocus="autofocus" placeholder="Tài khoản"/>
                </div>
                <div class="form-group">
                    <label for="pwd">Mật khẩu:</label>
                    <input type="password" class="form-control" id="pwd" name="password" required="required"
                           placeholder="Mật khẩu"/>
                </div>
                <input type="submit" class="btn btn-primary" name="submit" value="Đăng nhập"/>
            </form>
        </div>
    </div><br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;
    <?php
}
?>
<!-- The Edit User Medal -->
<div class="modal fade" id="editMedal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h2 class="modal-title text-danger">Đổi mật khẩu</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="container">
                    <form action="index.php" method="post">
                        <input style="visibility: hidden;" type="text" class="form-control" id="h_id" name="h_id"/>
                        <div class="form-group">
                            <label for="account">Tài khoản:</label>
                            <input pattern="[a-z0-9]+" type="text" class="form-control" id="up_account" name="account"
                                   autofocus="autofocus"
                                   required="required"
                                   placeholder="Nhập tk ít nhất 6 từ, không viết hoa, viết liền không dấu" id="name"
                                   readonly="readonly"/>
                        </div>
                        <div class="form-group">
                            <label for="fullname">Họ và tên:</label>
                            <input pattern=".{8,}" placeholder="Họ và tên ít nhất 8 ký tự" type="text"
                                   class="form-control" id="up_fullname" name="fullname" required="required"/>
                        </div>
                        <div class="form-group">
                            <label for="oldpass">Mật khẩu hiện tại:</label>
                            <input pattern=".{6,}" placeholder="Mật khẩu ít nhất 6 ký tự" type="password"
                                   class="form-control" id="oldpass" name="oldpass" required="required"/>
                        </div>
                        <div class="form-group">
                            <label for="pass">Mật khẩu mới:</label>
                            <input pattern=".{6,}" placeholder="Mật khẩu ít nhất 6 ký tự" type="password"
                                   class="form-control" id="pass" name="password" required="required"/>
                            <label for="pass2">Nhập lại mật khẩu mới:</label>
                            <input pattern=".{6,}" placeholder="Mật khẩu ít nhất 6 ký tự" type="password"
                                   class="form-control" id="pass2" name="password2"
                                   required="required"/>
                        </div>
                        <input type="submit" class="btn btn-primary" value="OK" name="update"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Edit User End-->
<script>
    function editValue(mid = 1, mname = "", mfullname = "", mper = 1) {
        document.getElementById("up_account").value = mname;
        document.getElementById("up_fullname").value = mfullname;
        document.getElementById("h_id").value = mid;
        document.getElementById("up_per").value = mper;
        if (mper == 1) {
            document.getElementById("up_per").selectedIndex = "0";
        } else {
            document.getElementById("up_per").selectedIndex = "1";
        }
    }
</script>
</body>
</html>


