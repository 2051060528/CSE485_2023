<?php
// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "2051060528";
$dbname = "btth02";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Kiểm tra và lấy giá trị classID từ POST khi nút Đăng ký được nhấn ở trang class.php
if (isset($_POST['classID'])) {
    $classID = $_POST['classID'];

    // Truy vấn dữ liệu lớp học tương ứng với classID
    $query = "SELECT cc.ClassID, c.Title, cs.ScheduleID, cs.ClassDate, cs.StartTime, cs.EndTime, cs.Location
              FROM classschedules cs
              INNER JOIN courseclasses cc ON cs.ClassID = cc.ClassID
              INNER JOIN courses c ON cc.CourseID = c.CourseID
              WHERE cc.ClassID = $classID";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo "<h2>Danh sách lịch học:</h2>";
        echo "<table class=\"class-table\">";
        echo "<tr><th>ClassID</th><th>Title</th><th>ScheduleID</th><th>ClassDate</th><th>StartTime</th><th>EndTime</th><th>Location</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['ClassID'] . "</td>";
            echo "<td>" . $row['Title'] . "</td>";
            echo "<td>" . $row['ScheduleID'] . "</td>";
            echo "<td>" . $row['ClassDate'] . "</td>";
            echo "<td>" . $row['StartTime'] . "</td>";
            echo "<td>" . $row['EndTime'] . "</td>";
            echo "<td>" . $row['Location'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Không có dữ liệu lịch học cho lớp này.";
    }
}

// Đóng kết nối cơ sở dữ liệu
$conn->close();
?>
<style>
    h2 {
        text-align: center;
    }

    .class-table {
        width: 100%;
        border-collapse: collapse;
    }

    .class-table th,
    .class-table td {
        padding: 8px;
        text-align: center;
        border: 1px solid #ddd;
    }

    .class-table th {
        background-color: #f2f2f2;
    }
</style>