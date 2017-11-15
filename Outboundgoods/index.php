<?php
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
$PNumber = $_GET["PNumber"];
if (is_array($_GET) && count($_GET) > 0)//判断是否有Get参数
{
    if ($Markingcode == null || $Markingcode == "") {
        $error->msg = "条形码不能为空";
        $error->isok = "0";
        echo json_encode($error);
    } else if ($PNumber == null || $PNumber == "") {
        $error->msg = "出库数量不能为空";
        $error->isok = "0";
        echo json_encode($error);
    } else {
        $sql = "SELECT Markingcode,PNumber FROM YzkProducts";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($Markingcode == $row["Markingcode"]) {
                    $cout = "";
                    if ($row["PNumber"] >= $PNumber) {
                        $cout = $row["PNumber"] - $PNumber;
                        $sql = "UPDATE YzkProducts SET PNumber = $cout WHERE Markingcode = $Markingcode";
                        mysqli_close($con);
                        if (mysqli_query($conn, $sql)) {
                            $error->ms = "更新成功";
                            $error->isok = "1";
                            echo json_encode($error);
                        } else {
                            $error->ms = "数据库插入失败";
                            $error->isok = "0";
                            echo json_encode($error);
                        }
                    } else {
                        $error->msg = "库存不足";
                        $error->isok = "0";
                        echo json_encode($error);
                    }
                }
            }
        }
    }
}
