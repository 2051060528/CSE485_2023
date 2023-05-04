<?php
require_once('BTTH01.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $masv = $_POST["masv"];
    $hoten = $_POST["hoten"];
    $gioitinh = $_POST["gioitinh"];
    $ngaysinh = $_POST["ngaysinh"];
    $diachi = $_POST["diachi"];

    $listOfStudent = new ListOfStudent();
    if (($handle = fopen("documents/ListOfStudent.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $student = new Student($data[0], $data[1], $data[2], $data[3], $data[4]);
            $listOfStudent->addStudent($student);
        }
        fclose($handle);
    }

    $existingStudent = $listOfStudent->findStudent($masv);
    if ($existingStudent == null) {
        $student = new Student($masv, $hoten, $gioitinh, $ngaysinh, $diachi);
        $handle = fopen("documents/ListOfStudent.csv", "a");

        // Ghi thông tin sinh viên mới vào file CSV
        fputcsv($handle, array($masv, $hoten, $gioitinh, $ngaysinh, $diachi));
        
        fclose($handle);

        echo "<p>Sinh viên mới đã được lưu thành công:</p>";
        echo "<p>Mã SV: " . $student->masv . "</p>";
        echo "<p>Họ tên: " . $student->hoten . "</p>";
        echo "<p>Giới tính: " . $student->gioitinh . "</p>";
        echo "<p>Ngày sinh: " . $student->ngaysinh . "</p>";
        echo "<p>Địa chỉ: " . $student->diachi . "</p>";
    } else {
        echo "<p>Sinh viên đã tồn tại với mã SV là " . $masv . "</p>";
    }
}
?>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Mã SV: <input type="text" name="masv"><br>
    Họ tên: <input type="text" name="hoten"><br>
    Giới tính:
    <input type="radio" name="gioitinh" value="Nam" checked>Nam
    <input type="radio" name="gioitinh" value="Nu">Nữ
    <br>
    Ngày sinh: <input type="text" name="ngaysinh"><br>
    Địa chỉ: <input type="text" name="diachi"><br>
    <input type="submit" value="Lưu">
</form>