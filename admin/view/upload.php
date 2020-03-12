<?php
defined("ADMIN") or die("<p style='text-align: center;'><img src='../resource/image/khoa.jpg' alt='lock'/></p>");
?>
<?php
/**
 * Created by PhpStorm.
 * User: Microsoft Windows
 * Date: 11/07/2019
 * Time: 9:17 PM
 */
$upload = new Apps_Class_Upload();
$param = [
    "select" => "*"
];
if (isset($_POST['up'])) {
    if (isset($_FILES['file'])) {
        $upload->setFile($_FILES['file']);
        Apps_Class_Log::writeFlowLog("view/upload.php đặt kích thước tối đa file 20MB");
        Apps_Class_Log::writeFlowLog("Thêm định dạng .doc .docx .xls .xlsx .pdf .ppt .pptx");
        $upload->extraExt();
        $upload->setMaxSize(20);
        Apps_Class_Log::writeFlowLog("view/upload.php bắt đầu ghi file");
        $upload->generateFolderAndFileName();
        $upload->uploadLocal();
        Apps_Class_Log::writeFlowLog("Bắt đầu tạo bản sao file");
        $fileName = $upload->getFileName();
        //------------- Copy file to other folder
        $folderEnd = "../resource/upload/";
        $folderStart = "./resource/upload/";
        if ($upload->copyFileToFolder($folderStart,$fileName,$folderEnd)) {
            Apps_Class_Log::writeLogSuccess("Đã tạo bản sao file thành công");
        } else {
            Apps_Class_Log::writeLogFail("Không thể tạo bản sao file");
        }
        //----------------------------------------
        Apps_Class_Log::moveTo("index.php?mod=upload");
    }
}
$params = [
    "select" => "distinct upload_date",
    "other" => "ORDER BY upload_date DESC"
];
$upload->setQuery($param);
Apps_Class_Log::writeFlowLog("view/upload.php thực hiện truy vấn lấy dữ liệu tổng");
$data = $upload->getResultFromSelectQuery($upload->queryData());
$upload->setQuery($params);
Apps_Class_Log::writeFlowLog("view/upload.php thực hiện truy vấn lấy dữ liệu theo cột");
$_date = $upload->getResultOnlyAColumn("upload_date");
?>
<div class="container">
    <h1 class="text-danger">Upload</h1>
    <form action="index.php?mod=upload" method="post" enctype="multipart/form-data">
        <div class="custom-file mb-3">
            <input type="file" class="custom-file-input" id="customFile" name="file" required="required">
            <label class="custom-file-label" for="customFile">Chọn file cần upload (Dung lượng tối đa 20MB)</label>
        </div>
        <div>
            <button type="submit" name="up" class="btn btn-primary">Upload</button>
        </div>
    </form>
    <div class="container">
        <h4>List</h4>
        <?php
        foreach ($_date as $val) {
            echo "<h6 class='w3-text-red'>Ngày upload: $val</h6>";
            for ($i = 0; $i < count($data); $i++) {
                if ($data[$i]['upload_date'] == $val && $data[$i]['upload_status'] != null) {
                    echo "<a class='w3-text-blue' style='text-decoration: none;' target='_blank' href='./resource/upload/" . $data[$i]['upload_src'] . "'> File: " . $data[$i]['upload_name'] . "</a> <a href='#' onclick=\"del('" . $data[$i]['upload_id'] . "')\" style='color:#9c27b0; font-weight: bold; text-decoration: none;'> -- Xóa --</a> <a href='./resource/upload/" . $data[$i]['upload_src'] . "' onclick=\"copy(this)\"><span style='color: blue;'>Copy link</span></a><br/>";
                }
            }
        }
        ?>
    </div>
</div>
</div>
<?php
if (isset($_GET['id']) && isset($_SESSION['per'])) {
    $id = $_GET['id'];
    $query = [
        "select" => "*",
        "where" => "upload_id = '" . $id . "'"
    ];
    $upload->setQuery($query);
    $src = $upload->getOneRow($upload->getResultFromSelectQuery($upload->queryData()))['upload_src'];
    Apps_Class_Log::writeFlowLog("Bắt đầu xóa file trên ổ cứng và trên bảng tbl_upload");
    $upload->deleteFile($src);
    Apps_Class_Log::writeFlowLog("Bắt đầu xóa file copy trên resource");
    if (unlink("../resource/upload/" . $src)) {
        Apps_Class_Log::writeLogSuccess("Đã xóa file copy trên resource thành công");
    } else {
        Apps_Class_Log::writeLogFail("Xóa file copy trên resource thất bại");
    }
    Apps_Class_Log::moveTo("index.php?mod=upload");
}
?>
<script>
    function del(id) {
        if (confirm("Bạn có chắc muốn xóa file này không?")) {
            open('index.php?mod=upload&id=' + id, '_self');
        }
    }
</script>