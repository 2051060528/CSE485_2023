<?php
class Student
{
    public $masv;
    public $hoten;
    public $gioitinh;
    public $ngaysinh;
    public $diachi;

    public function __construct($masv, $hoten, $gioitinh, $ngaysinh, $diachi)
    {
        $this->masv = $masv;
        $this->hoten = $hoten;
        $this->gioitinh = $gioitinh;
        $this->ngaysinh = $ngaysinh;
        $this->diachi = $diachi;
    }
}

class ListOfStudent
{
    public $list;

    public function __construct()
    {
        $this->list = array();
    }

    public function addStudent($student)
    {
        array_push($this->list, $student);
    }

    public function removeStudent($masv)
    {
        foreach ($this->list as $key => $student) {
            if ($student->masv == $masv) {
                unset($this->list[$key]);
            }
        }
    }

    public function findStudent($masv)
    {
        foreach ($this->list as $student) {
            if ($student->masv == $masv) {
                return $student;
            }
        }
        return null;
    }

    public function getAllStudents()
    {
        return $this->list;
    }
}
?>