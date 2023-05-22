<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
?>

<?php

// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$database = "btth02";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

// Xử lý dữ liệu khi form được gửi
$successMessage = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $AttendanceTime = date("Y-m-d H:i:s"); // Lấy thời gian hiện tại
    $AttendanceStatus = $_POST["status"];
    $StudentID = $_POST["student_id"];
    $ClassID = $_POST["class_id"];

    // Tạo câu lệnh INSERT INTO để chèn dữ liệu vào bảng
    $sql = "INSERT INTO attendance (AttendanceTime, AttendanceStatus, StudentID, ClassID) VALUES ( '$AttendanceTime', '$AttendanceStatus', '$StudentID', '$ClassID')";

    if ($conn->query($sql) === true) {
        $successMessage = "Điểm danh thành công!";
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
  }

// Đóng kết nối
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Form Điểm Danh</title>
   <link rel="stylesheet" type="text/css" href="diemdanh.css">   
  <?php if ($successMessage): ?>
      <div class="success-message"><?php echo $successMessage; ?></div>
  <?php endif; ?>
</head>
<body>
  <div class="container">
    <h2>Điểm Danh</h2>
   
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <div class="form-group">
        <label for="time">Thời gian điểm danh:</label>
        <input type="text" id="time" name="time" value="<?php echo date('Y-m-d H:i:s'); ?>" disabled>
      </div>

      <div class="form-group">
        <label>Trạng thái điểm danh:</label>
        <input type="radio" id="present" name="status" value="Có mặt"for="present">Có mặt
        <input type="radio" id="late" name="status" value="Muộn" for="late">Muộn
        <input type="radio" id="absent" name="status" value="Vắng mặt" for="absent">Vắng mặt
      </div>

      <div class="form-group">
        <label for="student_id">ID Sinh viên:</label>
        <input type="text" id="student_id" name="student_id">
      </div>

      <div class="form-group">
        <label for="class_id">ID Lớp:</label>
        <input type="text" id="class_id" name="class_id">
      </div>

      <div class="form-group">
        <button type="submit">Gửi</button>
    </div>
    </form>
    
     
  </div>
</body>
</html>
