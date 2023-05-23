<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        text-align: left;
        padding: 10px;
    }

    th {
        background-color: #f2f2f2;
    }
</style>

<?php
// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "2051060528";
$dbname = "btth02";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Đặt phương thức xác thực là "mysql_native_password"
$conn->query("SET SESSION old_passwords=0");
$conn->query("SET GLOBAL sql_mode='NO_ENGINE_SUBSTITUTION'");

// Lấy danh sách các ClassID
$classIDList = array();
$sqlClassID = "SELECT DISTINCT ClassID FROM courses";
$resultClassID = $conn->query($sqlClassID);
if ($resultClassID->num_rows > 0) {
    while ($rowClassID = $resultClassID->fetch_assoc()) {
        $classIDList[] = $rowClassID['ClassID'];
    }
}

// Xử lý yêu cầu khi nhấn nút "Tìm kiếm"
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['class_id'])) {
        $selectedClassID = $_POST['class_id'];

        // Hiển thị bảng dữ liệu
        echo "<h2>Báo cáo chuyên cần</h2>";
        echo "<table>";
        echo "<tr>
                <th>Thời gian điểm danh</th>
                <th>Trạng thái điểm danh</th>
                <th>Tên sinh viên</th>
                <th>Ngày học</th>
                <th>Thời gian bắt đầu</th>
                <th>Thời gian kết thúc</th>
                <th>Tên khóa học</th>
            </tr>";

        $sqlData = "SELECT a.AttendanceTime, a.AttendanceStatus, s.Name, cs.ClassDate, cs.StartTime, cs.EndTime, c.Title
                    FROM attendance a
                    INNER JOIN students s ON a.StudentID = s.StudentID
                    INNER JOIN classschedules cs ON a.ClassID = cs.ClassID
                    INNER JOIN courses c ON a.ClassID = c.ClassID
                    WHERE a.ClassID = '$selectedClassID'";

        $resultData = $conn->query($sqlData);
        if ($resultData->num_rows > 0) {
            while ($rowData = $resultData->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$rowData['AttendanceTime']."</td>";
                echo "<td>".$rowData['AttendanceStatus']."</td>";
                echo "<td>".$rowData['Name']."</td>";
                echo "<td>".$rowData['ClassDate']."</td>";
                echo "<td>".$rowData['StartTime']."</td>";
                echo "<td>".$rowData['EndTime']."</td>";
                echo "<td>".$rowData['Title']."</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>Không có dữ liệu.</td></tr>";
        }

        echo "</table>";
    }
}
?>

<form method="POST" action="">
    <label for="class_id">Mã lớp học:</label>
    <select id="class_id" name="class_id">
        <option value="">Chọn Class ID</option>
        <?php foreach ($classIDList as $classID) { ?>
            <option value="<?php echo $classID; ?>"><?php echo $classID; ?></option>
        <?php } ?>
    </select>

    <input type="submit" value="Tìm kiếm">
</form>
