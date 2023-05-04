<?php
require_once('BTTH01.php');

$listOfStudent = new ListOfStudent();
if (($handle = fopen("documents/ListOfStudent.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $student = new Student($data[0], $data[1], $data[2], $data[3], $data[4]);
        $listOfStudent->addStudent($student);
    }
    fclose($handle);
}

$students = $listOfStudent->getAllStudents();
foreach ($students as $student) {
    echo $student->masv . " - " . $student->hoten . " - " . $student->gioitinh . " - " . $student->ngaysinh . " - " . $student->diachi . "<br>";
  }
  ?>