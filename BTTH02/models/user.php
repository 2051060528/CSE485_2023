<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "btth02";
// Kết nối tới cơ sở dữ liệu
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Không thể kết nối tới cơ sở dữ liệu: " . $conn->connect_error);
}

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Kiểm tra đăng nhập
    $sql = "SELECT * FROM users WHERE Email = '$username' AND Password = '$password'";
    $result = $conn->query($sql);
//truy van
    // if($result->num_rows > 0) {
    //     header("Location: diemdanh.php");
    //     exit();
    // } else {
    //     $error = "Tên đăng nhập hoặc mật khẩu không đúng! Hãy nhập lại.";
    // }
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $accessRole = $row['AccessRole'];
        
        if ($accessRole == 'admin') {
            // Chuyển hướng đến trang diemdanh.php nếu là admin
            header("Location: instructors.php");
            exit();
        } elseif ($accessRole == 'user') {
            // Chuyển hướng đến trang student.php nếu là user
            header("Location: student.php");
            exit();
        }
    } else {
        echo "Email hoặc mật khẩu không đúng! Hãy nhập lại.";
    }
}

$conn->close();
?>
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login: diem danh, dang ki hoc</title>
    <!-- <link rel="stylesheet" href="./users.css"> -->
    <link rel="stylesheet" type="text/css" href="../assets/css/users.css">

</head>
<body>
<div class="login-container">
<img src="https://inkythuatso.com/uploads/thumbnails/800/2021/12/logo-dai-hoc-thuy-loi-inkythuatso-converted-01-23-08-45-05.jpg" alt="Image" width="300" height="250">
    <h2>PHẦN MỀM ĐIỂM DANH VÀ ĐĂNG KÍ HỌC CHO SINH VIÊN</h2>
    <?php if(isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <label>Tên đăng nhập:</label><br>
        <input type="text" name="username" required><br><br>
        <label>Mật khẩu:</label><br>
        <input type="password" name="password" required><br><br>
        <input type="submit" name="submit" value="Đăng nhập">
    </form>
    <div class="forgot-password">
            <a href="doimatkhau.php">Quên mật khẩu?</a>
        </div>
    </div>
</body>
</html>
