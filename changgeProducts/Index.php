<?php
/**
 * Created by PhpStorm.
 * User: zs
 * Date: 17/11/3
 * Time: 上午9:23
 */
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "tddatabase";
// 创建连接
$conn = mysqli_connect($servername, $username, $password, $dbname);
// 检测连接
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
/*获取前端接口数据*/
$Markingcode = $_GET["Markingcode"];
$Pname = $_GET["Pname"];
$Pstyle = $_GET["Pstyle"];
$Pcolor = $_GET["Pcolor"];
$Pdate = $_GET["Pdate"];
$Pstate = $_GET["Pstate"];
$Psize = $_GET["Psize"];
$PNumber = $_GET["PNumber"];
if (is_array($_GET) && count($_GET) > 0)//判断是否有Get参数
{
    if ($Markingcode == null || $Markingcode == "") {
        $error->msg = "条形码不能为空";
        $error->isok = "0";
        echo json_encode($error);
    } elseif ($Pname == null || $Pname == "") {
        $error->isok = "0";
        $error = "备注不能为空";
        echo json_encode($error);
    } elseif ($PNumber == null || $PNumber == "") {
        $error->msg = "库存不能为空";
        $error->isok = "0";
        echo json_encode($error);
    } elseif ($Psize == null || $Psize == "") {
        $error->msg = "鞋子尺寸不能为空";
        $error->isok = "0";
        echo json_encode($error);
    } elseif ($Pstyle == null || $Pstyle == "") {
        $error->msg = "类型不能为空";
        $error->isok = "0";
        echo json_encode($error);
    } elseif ($Pcolor == null || $Pcolor == "") {
        $error->msg = "颜色不能为空";
        $error->isok = "0";
        echo json_encode($error);
    } elseif ($Pdate == null || $Pdate == "") {
        $error = "时间不能为空";
        $error->isok = "0";
        echo json_encode($error);
    } elseif ($Pstate == null || $Pstate == "") {
        $error->msg = "状态不能为空";
        $error->isok = "0";
        echo json_encode($error);
    } else {
        $sql = "UPDATE YzkProducts SET Pstyle = $Pstyle,Pname = $Pname,Pcolor = $Pcolor,Psize = $Psize,Pdate = $Pdate,PNumber = $PNumber WHERE Markingcode = $Markingcode";
        mysqli_close($con);
        if (mysqli_query($conn, $sql)) {
            $error->msg = "更新成功";
            $error->isok = "1";
            echo json_encode($error);
        } else {
            $error->msg = "数据库插入失败";
            $error->isok = "0";
            echo json_encode($error);
        }
    }
}