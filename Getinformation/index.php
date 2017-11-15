<?php
/**
 * Created by PhpStorm.
 * User: baird
 * Date: 2017/11/15
 * Time: 上午11:05
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

class datamodel
{
    public $Markingcode;
    public $Pname;
    public $Pstyle;
    public $Pcolor;
    public $Pdate;
    public $Pstate;
    public $Psize;
    public $PNumber;

}

class Model
{
    public $data = array();
    public $state = "";
}

$Model = new Model();
$datamodel = new datamodel();
$Markingcode = $_GET["Markingcode"];
if (is_array($_GET) && count($_GET) > 0)//判断是否有Get参数
{
    if ($Markingcode == null || $Markingcode == "") {
        echo json_encode("请输入条形码");
    } else {
        $sql = "SELECT Markingcode,Pname,Pstyle,Pcolor,Pdate,Pstate,Psize,PNumber FROM YzkProducts";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // 输出数据
            if ($Markingcode == 1) {
                while ($row = $result->fetch_assoc()) {
                    $Model->data[] = $row;
                }
            } else {
                while ($row = $result->fetch_assoc()) {
                    if ($Markingcode == $row["Markingcode"]) {
                        $Model->data[] = $row;
                    }
                }
            }
        }
        echo json_encode($Model);
    }
} else {
    echo '没有数据';
}
