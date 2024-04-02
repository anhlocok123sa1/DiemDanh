<?php
session_start();
include_once ("config.php");
if (isset($_POST["selected"])) {
    $selected = $_POST["selected"];
    $mssv = $_POST["mssv"];
    if($selected == 'All'){
        $sql = "SELECT ID,STUDENTID,NAME,ma_lop,TIMEIN,MaMH FROM table_attendance WHERE STUDENTID='$mssv'";
    }else {
        $sql = "SELECT ID,STUDENTID,NAME,ma_lop,TIMEIN,MaMH FROM table_attendance WHERE STUDENTID='$mssv' and MaMH='$selected'";
    }
    $query = $conn->query($sql);
    while ($row = $query->fetch_assoc()) {
        ?>
        <tr>
            <td>
                <?php echo $row['ID']; ?>
            </td>
            <td>
                <?php echo $row['STUDENTID']; ?>
            </td>
            <td>
                <?php echo $row['NAME']; ?>
            </td>
            <td>
                <?php echo $row['ma_lop']; ?>
            </td>
            <td>
                <?php echo $row['TIMEIN']; ?>
            </td>
            <td>
                <?php
                $sql1 = "SELECT NAME FROM MON_HOC WHERE MAMH='" . $row['MaMH'] . "'";
                $query1 = $conn->query($sql1);
                while ($row1 = $query1->fetch_assoc()) {
                    echo $row1['NAME'];
                }
                ?>
            </td>
        </tr>
        <?php
    }

}
?>