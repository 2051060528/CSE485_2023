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

// Kiểm tra và lấy giá trị courseID từ POST khi nút Đăng ký được nhấn ở course.php
if (isset($_POST['courseID'])) {
    $courseID = $_POST['courseID'];

    // Truy vấn dữ liệu tương ứng với courseID
    $query = "SELECT cc.ClassID, c.Title, i.NameIns, cs.StartTime, cs.EndTime 
              FROM courseclasses cc
              INNER JOIN courses c ON cc.CourseID = c.CourseID
              INNER JOIN instructors i ON cc.InstructorID = i.InstructorID
              INNER JOIN classschedules cs ON cc.ScheduleID = cs.ScheduleID
              WHERE c.CourseID = $courseID";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo "<h2>Danh sách lớp học:</h2>";
        echo "<table class=\"class-table\">";
        echo "<tr><th>Mã lớp</th><th>Tên khóa học</th><th>Tên giảng viên</th><th>Thời gian bắt đầu</th><th>Thời gian kết thúc</th><th>Đăng ký</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['ClassID'] . "</td>";
            echo "<td>" . $row['Title'] . "</td>";
            echo "<td>" . $row['NameIns'] . "</td>";
            echo "<td>" . $row['StartTime'] . "</td>";
            echo "<td>" . $row['EndTime'] . "</td>";
            echo "<td>";
            echo "<form action=\"schedule.php\" method=\"post\">";
            echo "<input type=\"hidden\" name=\"studentID\" value=\"1\">"; 
            echo "<input type=\"hidden\" name=\"classID\" value=\"" . $row['ClassID'] . "\">";
            echo "<button type=\"submit\" name=\"register\">Đăng ký</button>";
            echo "</form>";
            echo "</td>";
        }

        echo "</table>";
    } else {
        echo "Không có dữ liệu lớp học.";
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