
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

// Truy vấn dữ liệu từ bảng `attendance`
$sql = "SELECT * FROM attendance";
$result = $conn->query($sql);


// Đóng kết nối
$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
  <title>Form Điểm Danh</title>
  <link rel="stylesheet" type="text/css" href="diemdanh.css">  
  <script>
    window.addEventListener('DOMContentLoaded', function() {
      var timeInput = document.getElementById('time');
      var currentTime = new Date().toISOString().slice(0, 19).replace('T', ' ');

      timeInput.value = currentTime;
    });
  </script>
</head>
<body>
  <div class="container">
    <h2>Điểm Danh</h2>
    <form method="POST" action="process.php">
      <div class="form-group">
        <label for="time">Thời gian điểm danh:</label>
        <input type="text" id="time" name="time" value="YYYY-MM-DD HH:MM:SS" disabled>
      </div>

      <div class="form-group">
        <label>Trạng thái điểm danh:</label>
        <input type="radio" id="present" name="status" value="present" for="present">Có mặt
        <input type="radio" id="late" name="status" value="late" for="late">muộn
        <input type="radio" id="absent" name="status" value="absent" for="absent">Vắng mặt
      </div>

      <div class="form-group">
        <label for="student-id">ID Sinh viên:</label>
        <input type="text" id="student-id" name="student_id">
      </div>

      <div class="form-group">
        <label for="class-id">ID Lớp:</label>
        <input type="text" id="class-id" name="class_id">
      </div>

      <div class="form-group">
        <button type="submit">Gửi</button>
      </div>
    </form>
  </div>
</body>
</html>
